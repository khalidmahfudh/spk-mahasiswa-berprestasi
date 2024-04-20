<?php

namespace App\Services\Impl;

use App\Models\HasilPreferensiMahasiswaAHP;
use App\Services\GenerateService;
use App\Models\Mahasiswa;
use App\Models\Kriteria;
use App\Models\IndexRatioAHP;
use App\Models\KriteriaTopsis;
use App\Models\HasilPreferensiMahasiswaTopsis;
use App\Models\KriteriaAHP;

class GenerateServiceImpl implements GenerateService

{

    function processTopsis(): array
    {
          /* METODE TOPSIS */

        // 1. Ambil Data Bobot Masing-masing Kriteria
        
        $kriteriaTopsis = KriteriaTopsis::with('kriteria')->get();
        $kriteria = Kriteria::all();

        // 2. Ambil Data Mahasiswa dan Nilai Kriteria

        $mahasiswa = Mahasiswa::with('nilai_kriteria_mahasiswa.kriteria')->get();

        // 3. Normalisasi Nilai Kriteria

        $nilaiMahasiswa = [];
        $nilaiNormalisasiMahasiswa = [];
        $pembagian = [];

        // 3.1 Nilai mahasiswa
        foreach ($mahasiswa as $mhs) {
            $nilaiKriteria = [];
            foreach ($mhs->nilai_kriteria_mahasiswa as $item) {
                $nilaiKriteria[] = $item->nilai;
            }
            $nilaiMahasiswa[] = $nilaiKriteria;
        }

        // 3.2 Mencari pembagian
        for ($i=0; $i < count($nilaiMahasiswa[0]); $i++) { 
            $totalKuadrat = 0;
            for ($j=0; $j < count($nilaiMahasiswa); $j++) { 
                $totalKuadrat += pow($nilaiMahasiswa[$j][$i], 2);
            }
            $akarKuadrat = sqrt($totalKuadrat);
            $pembagian[$i] = $akarKuadrat;
        }

        // 3.3 Nilai mahasiswa dinormalisasi (Euclidean length of a vector)
        for ($i=0; $i < count($nilaiMahasiswa); $i++) { 
            for ($j=0; $j < count($nilaiMahasiswa[$i]); $j++) { 
                $nilaiNormalisasiMahasiswa[$i][$j] = $nilaiMahasiswa[$i][$j] / $pembagian[$j];
            }
        }

        // 4. Nilai normalisasi mahasiswa dikali bobot masing-masing kriteria
        $nilaiNormalisasiMahasiswaTerbobot = [];
        for ($i=0; $i < count($nilaiNormalisasiMahasiswa); $i++) { 
            for ($j=0; $j < count($nilaiNormalisasiMahasiswa[$i]); $j++) { 
                $nilaiNormalisasiMahasiswaTerbobot[$i][$j]['keterangan'] = $kriteriaTopsis[$j]->keterangan;
                $nilaiNormalisasiMahasiswaTerbobot[$i][$j]['nilai'] = $nilaiNormalisasiMahasiswa[$i][$j] * $kriteriaTopsis[$j]->bobot_id;
            }
        }

        // 5. Mencari Nilai Solusi ideal posistif dan solusi ideal negatif
        // jika kriteria benefit solusi ideal positif (maks) nilai tertingi dan sebaliknya jika cost.

        $nilaiSolusiIdeal = [];
        $nilaiSolusiIdealAlt = [];
        for ($i=0; $i < count($nilaiNormalisasiMahasiswaTerbobot[0]); $i++) { 

            $keterangan = array_column(array_column($nilaiNormalisasiMahasiswaTerbobot, $i), 'keterangan')[0] ;

            if ( $keterangan == 'benefit' ) {
                $nilaiSolusiIdealAlt['maks'] = max(array_column(array_column($nilaiNormalisasiMahasiswaTerbobot, $i), 'nilai'));
                $nilaiSolusiIdealAlt['min'] = min(array_column(array_column($nilaiNormalisasiMahasiswaTerbobot, $i), 'nilai'));
            } else {
                $nilaiSolusiIdealAlt['maks'] = min(array_column(array_column($nilaiNormalisasiMahasiswaTerbobot, $i), 'nilai'));
                $nilaiSolusiIdealAlt['min'] = max(array_column(array_column($nilaiNormalisasiMahasiswaTerbobot, $i), 'nilai'));
            }

            $nilaiSolusiIdeal[] = $nilaiSolusiIdealAlt;
        }

        // 6. Mencari D+ dan D- Mahasiswa
        // D+ = sqrt(pow(maks[0] - nilaiNormalisasimhs kriteria[0]))
        // D- = sqrt(pow(nilaiNormalisasimhs kriteria[0] - min[0]))

        $nilai_dplus_dminus= [];
        for ($i=0; $i < count($nilaiNormalisasiMahasiswaTerbobot); $i++) { 
            $total_kuadrat_dplus = 0;
            $total_kuadrat_dminus = 0;
            for ($j=0; $j < count($nilaiNormalisasiMahasiswaTerbobot[$i]); $j++) { 
                $total_kuadrat_dplus += pow($nilaiSolusiIdeal[$j]['maks'] - $nilaiNormalisasiMahasiswaTerbobot[$i][$j]['nilai'], 2);
                $total_kuadrat_dminus += pow($nilaiNormalisasiMahasiswaTerbobot[$i][$j]['nilai'] - $nilaiSolusiIdeal[$j]['min'] , 2);
            }
            $akar_kuadrat_dplus = sqrt($total_kuadrat_dplus);
            $akar_kuadrat_dminus = sqrt($total_kuadrat_dminus);
            $nilai_dplus_dminus[] = [
                'D+' => $akar_kuadrat_dplus,
                'D-' => $akar_kuadrat_dminus
            ];
        }

        // 7. Mencari Preferensi dan memasukkan ke dalam table hasil_preferensi_topsis
        // Preferensi = D- / (D- + D+)

        $nilaiPreferensi = [];
        foreach ($mahasiswa as $key => $mhs) {
            $nilaiPreferensi[] = [
                'mahasiswa_id' => $mhs->id,
                'preferensi' => $nilai_dplus_dminus[$key]['D-'] / ($nilai_dplus_dminus[$key]['D-'] + $nilai_dplus_dminus[$key]['D+'])
            ];
        }

        usort($nilaiPreferensi, function($a, $b) {
            return $b['preferensi'] <=> $a['preferensi'];
        });

        HasilPreferensiMahasiswaTopsis::truncate();

        HasilPreferensiMahasiswaTopsis::insert($nilaiPreferensi);

        $dataProcessTopsis = compact('kriteriaTopsis', 'kriteria', 'mahasiswa', 'nilaiMahasiswa', 'nilaiNormalisasiMahasiswa', 'pembagian', 'nilaiNormalisasiMahasiswaTerbobot', 'nilaiSolusiIdeal', 'nilai_dplus_dminus');

        return $dataProcessTopsis;
    }

    function processAhp(): array
    {
         // METODE AHP

        // 1. Menetapkan prioritas elemen, membandingkan masing2 kriteria dan masing2 mahasiswa satu sama lain.
        // 1.1 Perbandingan masing-masing kritera
        $mahasiswa = Mahasiswa::with('nilai_kriteria_mahasiswa.kriteria')->get();

        $kriteriaAHP = KriteriaAHP::all();

        $kriteria = Kriteria::all();
        $nilaiPerbandinganKriteria = [];

        for ($i=0; $i < count($kriteria); $i++) { 
            for ($j=0; $j < count($kriteria); $j++) { 
                $data = $kriteriaAHP->first(function ($item) use ($kriteria, $i, $j) {
                    return $item->kriteria_id_sumbu_x == $kriteria[$i]->id && $item->kriteria_id_sumbu_y == $kriteria[$j]->id;
                });
                $nilaiPerbandinganKriteria[$i][$j] = $data->nilai;
            }
        }

        // 1.2 Nilai perbandingan kriteria dilakukan sintesis
        // 1.2.1 Mencari hasil jumlah perbandingan perkolom nya

        $sumNilaiPerbandinganKriteria = [];
        for ($i=0; $i < count($nilaiPerbandinganKriteria[0]); $i++) { 
            $sumNilaiPerbandinganKriteria[$i] = array_column($nilaiPerbandinganKriteria, $i);
            $sumNilaiPerbandinganKriteria[$i] = array_sum($sumNilaiPerbandinganKriteria[$i]);
        }

        // 1.2.2 Mencari nilai eigen (nilai perbandingan / masing2 $sumNilaiPerbandinganKriteria)

        $nilaiEigenPerbandinganKriteria = [];

        for ($i=0; $i < count($nilaiPerbandinganKriteria); $i++) { 
            for ($j=0; $j < count($nilaiPerbandinganKriteria[$i]); $j++) { 
                $nilaiEigenPerbandinganKriteria[$i][$j] = $nilaiPerbandinganKriteria[$i][$j] / $sumNilaiPerbandinganKriteria[$j];
            }
        }

        $sumAvgNilaiEigenBarisPerbandinganKriteria = [];
        $jumlahKriteria = Kriteria::count();
        for ($i=0; $i < count($nilaiEigenPerbandinganKriteria); $i++) { 
            $sumAvgNilaiEigenBarisPerbandinganKriteria[$i] = [
                'sum' => array_sum($nilaiEigenPerbandinganKriteria[$i]),
                'avg' => array_sum($nilaiEigenPerbandinganKriteria[$i]) / $jumlahKriteria
            ];
        }
        $totalAvgNilaiEigenBarisPerbandinganKriteria = array_sum(array_column($sumAvgNilaiEigenBarisPerbandinganKriteria,'avg'));

        // 1.2.3 melakukan perhitungan Consistency Index (CI) dan Consistency Ratio (CR)
        // CI = (λ (lamda) maks - n) / (n-1)
        $lamdaMaksKriteria = 0;
        for ($i=0; $i < $jumlahKriteria; $i++) { 
            $lamdaMaksKriteria += $sumNilaiPerbandinganKriteria[$i] * $sumAvgNilaiEigenBarisPerbandinganKriteria[$i]['avg'];
        }

        $CI_Kriteria = ($lamdaMaksKriteria - $jumlahKriteria) / ($jumlahKriteria - 1);

        // CR = CI / IR

        $IR_Kriteria = IndexRatioAHP::where('jumlah_elemen', $jumlahKriteria)->first()->nilai;

        if (!$IR_Kriteria) {
            $IR_Kriteria = 1; // Jika tidak ditemukan, return angka 1
        }

        $CR_Kriteria = $CI_Kriteria / $IR_Kriteria;

        // 1.3 Perbandingan masing-masing alternatif(mahasiswa) terhadap kriteria yang ada

        $nilaiPerbandinganAlternatif = [];

        for ($i=0; $i < $jumlahKriteria; $i++) { 
        
            for ($j=0; $j < count($mahasiswa); $j++) { 

                for ($k=0; $k < count($mahasiswa); $k++) { 
                    // min max nilai diberikan masing-masing kriteria
                    $min_nilai_kriteria = $kriteria[$i]->min_nilai;
                    $max_nilai_kriteria = $kriteria[$i]->max_nilai;

                    // selisih min dan max di bagi 9 (maks nilai perbandingan) untuk mengatur perbandingan nilai antar mhs
                    $selisihMaxMinKriteria = ($max_nilai_kriteria - $min_nilai_kriteria) / 9;

                    $nilai_mhs_x = $mahasiswa[$j]->nilai_kriteria_mahasiswa[$i]->nilai;
                    $nilai_mhs_y = $mahasiswa[$k]->nilai_kriteria_mahasiswa[$i]->nilai;
                    
                    if ($nilai_mhs_x == $nilai_mhs_y) {
                        $nilaiPerbandingan = 1;
                    } elseif($nilai_mhs_x > $nilai_mhs_y) {
                        $selisih = $nilai_mhs_x - $nilai_mhs_y;

                        $nilaiPerbandingan = ceil($selisih / $selisihMaxMinKriteria);
                        if($nilaiPerbandingan > 9) $nilaiPerbandingan = 9;
                        if($nilaiPerbandingan == 1) $nilaiPerbandingan = 2;
                    } else {
                        $selisih = $nilai_mhs_y - $nilai_mhs_x;

                        $nilaiPerbandingan = ceil($selisih / $selisihMaxMinKriteria);
                        if($nilaiPerbandingan > 9) $nilaiPerbandingan = 9;
                        if($nilaiPerbandingan == 1) $nilaiPerbandingan = 2;

                        $nilaiPerbandingan = 1 / $nilaiPerbandingan;
                    }
                
                    $nilaiPerbandinganAlternatif[$i][$j][$k] = $nilaiPerbandingan;

                }

            }

        }

        // 1.4 Nilai perbandingan alternatif terhadap masing-masing kriteria dilakukan sintesis
        // 1.4.1 Mencari hasil jumlah perbandingan perkolom nya

        $sumNilaiPerbandinganAlternatif = [];
        for ($i=0; $i < count($nilaiPerbandinganAlternatif); $i++) { 
            for ($j=0; $j < count($nilaiPerbandinganAlternatif[$i]); $j++) { 
                $sumNilaiPerbandinganAlternatif[$i][$j] = array_column($nilaiPerbandinganAlternatif[$i], $j);
                $sumNilaiPerbandinganAlternatif[$i][$j] = array_sum($sumNilaiPerbandinganAlternatif[$i][$j]);
            }
        }

         // 1.3.2 Mencari nilai eigen (nilai perbandingan / masing2 $sumNilaiPerbandinganAlternatif)

        $nilaiEigenPerbandinganAlternatif = [];

        for ($i=0; $i < count($nilaiPerbandinganAlternatif); $i++) { 
            for ($j=0; $j < count($nilaiPerbandinganAlternatif[$i]); $j++) { 
                for ($k=0; $k < count($nilaiPerbandinganAlternatif[$i][$j]); $k++) { 
                    $nilaiEigenPerbandinganAlternatif[$i][$j][$k] = $nilaiPerbandinganAlternatif[$i][$j][$k] / $sumNilaiPerbandinganAlternatif[$i][$k];
                }
            }
        }

        $sumAvgNilaiEigenBarisPerbandinganAlternatif = [];
        $jumlahAlternatif = Mahasiswa::count();

        for ($i=0; $i < count($nilaiEigenPerbandinganAlternatif); $i++) { 
            for ($j=0; $j < count($nilaiEigenPerbandinganAlternatif[$i]); $j++) { 
                $sumAvgNilaiEigenBarisPerbandinganAlternatif[$i][$j] = [
                    'sum' => array_sum($nilaiEigenPerbandinganAlternatif[$i][$j]),
                    'avg' => array_sum($nilaiEigenPerbandinganAlternatif[$i][$j]) / $jumlahAlternatif
                ];
            }
        }

        for ($i=0; $i < count($nilaiEigenPerbandinganAlternatif); $i++) { 
            $totalAvgNilaiEigenBarisPerbandinganAlternatif[$i] = array_sum(array_column($sumAvgNilaiEigenBarisPerbandinganAlternatif[$i],'avg'));
        }

        // 1.4.2 melakukan perhitungan Consistency Index (CI) dan Consistency Ratio (CR)
        // CI = (λ (lamda) maks - n) / (n-1)

        $lamdaMaksAlternatif = [];
        for ($i=0; $i < $jumlahKriteria; $i++) { 
            $lamdaMaksAlternatif[$i] = 0;
            for ($j=0; $j < $jumlahAlternatif; $j++) { 
                $lamdaMaksAlternatif[$i] += $sumNilaiPerbandinganAlternatif[$i][$j] * $sumAvgNilaiEigenBarisPerbandinganAlternatif[$i][$j]['avg'];
            }
        }

        $CI_Alternatif = [];
        for ($i=0; $i < $jumlahKriteria; $i++) { 
            $CI_Alternatif[$i] = ($lamdaMaksAlternatif[$i] - $jumlahAlternatif) / ($jumlahAlternatif - 1);
        }

        // CR = CI / IR

        $IR_Alternatif = IndexRatioAHP::where('jumlah_elemen', $jumlahAlternatif)->first()->nilai;

        if (!$IR_Alternatif) {
            $IR_Alternatif = 1; // Jika tidak ditemukan, return angka 1
        }

        $CR_Alternatif = [];
        for ($i=0; $i < $jumlahKriteria; $i++) { 
            $CR_Alternatif[$i] = $CI_Alternatif[$i] / $IR_Alternatif;
        }

        // 2. Mencari Preferensi dan memasukkan ke dalam table hasil_preferensi_ahp
        // preferensi=(rata_rata ipk x rata_rata ipk mahasiswa)+
        //(rata_rata karya_ilmiah x rata_rata karya_ilmiah mahasiswa)+
        //(rata_rata prestasi x rata_rata prestasi mahasiswa)+
        //(rata_rata non_akademik x rata_rata non_akademik mahasiswa)+
        //(rata_rata toelf x rata_rata toefl mahasiswa).

        $nilaiPreferensi = [];
        foreach ($mahasiswa as $i => $mhs) {
            $nilai = 0;
            for ($j=0; $j < $jumlahKriteria; $j++) { 
                $nilai += $sumAvgNilaiEigenBarisPerbandinganKriteria[$j]['avg'] * $sumAvgNilaiEigenBarisPerbandinganAlternatif[$j][$i]['avg'];
            }
            $nilaiPreferensi[$i] = [
                'mahasiswa_id' => $mhs->id,
                'preferensi' => $nilai
            ];
        }

        usort($nilaiPreferensi, function($a, $b) {
            return $b['preferensi'] <=> $a['preferensi'];
        });

        HasilPreferensiMahasiswaAHP::truncate();

        HasilPreferensiMahasiswaAHP::insert($nilaiPreferensi);

        $dataProcessAhp = compact('kriteriaAHP', 'mahasiswa', 'kriteria', 'nilaiPerbandinganKriteria', 'sumNilaiPerbandinganKriteria', 'nilaiEigenPerbandinganKriteria', 'sumAvgNilaiEigenBarisPerbandinganKriteria', 'jumlahKriteria', 'totalAvgNilaiEigenBarisPerbandinganKriteria', 'lamdaMaksKriteria', 'CI_Kriteria', 'IR_Kriteria', 'CR_Kriteria', 'nilaiPerbandinganAlternatif', 'sumNilaiPerbandinganAlternatif', 'nilaiEigenPerbandinganAlternatif', 'sumAvgNilaiEigenBarisPerbandinganAlternatif', 'jumlahAlternatif', 'totalAvgNilaiEigenBarisPerbandinganAlternatif', 'lamdaMaksAlternatif', 'CI_Alternatif', 'IR_Alternatif', 'CR_Alternatif');

        return $dataProcessAhp;
    }

}