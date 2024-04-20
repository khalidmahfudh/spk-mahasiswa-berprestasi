// Fetch detail user
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('detail-button')) {
        let id = event.target.dataset.id;

        fetch('/manageusers/detail?id=' + id, {
                headers: {
                    'X-Requested-With' : 'fetch'
                }
        })
            .then(response => response.json())
            .then(data => {
                const user = data.user;
                const userRole = user.is_active ? 'Aktif' : 'Tidak Aktif';

                document.querySelector(".modal-title").innerHTML = `Detail user ${user.name}`;
                document.querySelector("#detail-name").value = user.name;
                document.querySelector("#detail-username").value = user.username;
                document.querySelector("#detail-email").value = user.email;
                document.querySelector("#detail-role").value = user.role;
                document.querySelector("#detail-active").value = userRole;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});

document.getElementById('file').addEventListener('change', function() {
    let fileName = this.files[0].name;
    document.getElementById('file-label').textContent = fileName;

    let file = this.files[0];
        let reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile-image').src = e.target.result;
        };
        reader.readAsDataURL(file);
});


function togglePasswordVisibility(elementId) {
    var input = document.getElementById(elementId);
    var icon = input.parentNode.querySelector('.input-group-text i');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }

    // Fokus ulang pada input setelah mengubah tipe
    input.focus();
}