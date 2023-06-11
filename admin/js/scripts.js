

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});



$(document).ready(function() {
    $("#saverefbtn").click(function(e) {
        e.preventDefault();
        var ref_doctorname = $("#ref_doctorname").val().trim();
        var ref_clinic = $("#ref_clinic").val().trim();
        var ref_phone = $("#ref_phone").val().trim();
        var ref_email = $("#ref_email").val().trim();
        var ref_reason = $("#ref_reason").val().trim();
        var isValid = true;


        if (ref_doctorname === "") {
        $("#ref_doctorname").addClass("is-invalid");
        isValid = false;
        } else {
        $("#ref_doctorname").removeClass("is-invalid");
        }

        if (ref_clinic === "") {
        $("#ref_clinic").addClass("is-invalid");
        isValid = false;
        } else {
        $("#ref_clinic").removeClass("is-invalid");
        }

        if (ref_phone === "") {
        $("#ref_phone").addClass("is-invalid");
        isValid = false;
        } else {
        $("#ref_phone").removeClass("is-invalid");
        }

        if (ref_email === "") {
        $("#ref_email").addClass("is-invalid");
        isValid = false;
        } else {
        $("#ref_email").removeClass("is-invalid");
        }

        if (ref_reason === "") {
        $("#ref_reason").addClass("is-invalid");
        isValid = false;
        } else {
        $("#ref_reason").removeClass("is-invalid");
        }
    

        if (isValid) {
            if (isValid) {
                var formData = $("#addreferralForm").serialize();
                $.ajax({
                    type: "POST",
                    url: "referral_process.php",
                    data: formData,
                    success: function(response) {
                        if(response == "success"){
                        Swal.fire(
                        'Good job!',
                        'You Successfully added the referral!',
                        'success'
                        ).then(function() {
                            window.location.reload();
                        });
                    }else if(response == "fail"){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'You already have an referral',
                            })
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something wrong with the code',
                            })
                    }
                    console.log(response);
                    },
                    error: function(error) {
                    alert("Error");
                    console.error(error);
                    }
                });
                }
        }
    });
    });  
    
    

                                                           

