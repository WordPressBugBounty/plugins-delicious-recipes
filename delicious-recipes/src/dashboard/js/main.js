(function ($) {

    if (document.querySelector('.dr-ud__sidebar')) {
        var drUdSidebar = document.querySelector('.dr-ud__sidebar');
        // var dr_archive_list_wrapper = document.querySelector('.dr-archive-list-wrapper');
        var sidebarToggleBtn = drUdSidebar.querySelector('.dr-sidebar-toggle-btn');
        var drDashboardSidebarCollapse = localStorage.getItem('drDashboardSidebarCollapse');
        if (drUdSidebar && sidebarToggleBtn) {
            if(drDashboardSidebarCollapse === 'yes'){
                drUdSidebar.classList.add('collapsed');
            }else{
                drUdSidebar.classList.remove('collapsed');
            }
            sidebarToggleBtn.addEventListener('click', function () {
                if(drUdSidebar.matches(".collapsed") ){
                    drUdSidebar.classList.remove('collapsed');
                    localStorage.setItem('drDashboardSidebarCollapse', 'no')
                }else{
                    drUdSidebar.classList.add('collapsed');
                    localStorage.setItem('drDashboardSidebarCollapse', 'yes')
                }
            })
        }
    }

    if (document.querySelector('.view-layout-buttons')) {
        var grid_view_btn = document.getElementById('grid-view');
        var list_view_btn = document.getElementById('list-view');
        var dr_archive_list = document.querySelector('.dr-archive-list');
        grid_view_btn.addEventListener('click', function () {
            dr_archive_list.classList.add('transitioning')

            this.classList.add('active');
            list_view_btn.classList.remove('active');
            setTimeout(function () {
                dr_archive_list.classList.remove('transitioning')
                dr_archive_list.classList.remove('list-view');
                dr_archive_list.classList.add('grid-view');
            }, 300)
        })
        list_view_btn.addEventListener('click', function () {
            dr_archive_list.classList.add('transitioning')
            this.classList.add('active');
            grid_view_btn.classList.remove('active');
            setTimeout(function () {
                dr_archive_list.classList.remove('transitioning')
                dr_archive_list.classList.remove('grid-view');
                dr_archive_list.classList.add('list-view');
            }, 300)
        })
    }

    // pw show toggle btn
    $(document).on('click', '.dr-input-wrap.has-pw-toggle-btn .pw-toggle-btn', function (e) {

        e.preventDefault();
        let element = $(this);
        let inputSibling = element.siblings('.dr-form__field-input.password');
        inputSibling[0].type = inputSibling[0].type == 'text' ? 'password' : 'text';
        let inputParent = element.parent();
        inputParent[0].classList.toggle('pw-show');

    });

    if (document.querySelector('#profile-img')) {
        var thisDZContainer_profile_img = $("#profile-img");

        toastr.options.positionClass = "toast-bottom-full-width";
        toastr.options.timeOut = "5000";

        var DZOBJ_profile_img = new Dropzone("#profile-img", {
            acceptedFiles: "image/jpeg, image/gif, image/png, image/webp, image/avif",
            maxFiles: 1,
            url: delicious_recipes.ajax_url,
            uploadMultiple: false,
            resizeWidth: 300,
            resizeMimeType: 'image/jpeg',
            resizeMethod: 'crop',
            resizeQuality: 65,
            createImageThumbnails: false,
            maxFilesize: 2,
            dictDefaultMessage: delicious_recipes.edit_profile_pic_msg,
        });

        DZOBJ_profile_img.on("addedfile", function (file) {
            // Create an image object to load the image and check its dimensions
            var img = new Image();
            img.onload = function () {
                const width = img.width;
                const height = img.height;
        
                // Define the allowed dimensions (example: 400px x 400px)
                const allowedWidth = 150;
                const allowedHeight = 150;
        
                // Check if the image meets the dimension requirements
                if (width > allowedWidth || height > allowedHeight) {
                    // Remove the file from Dropzone if it doesn't meet the dimension criteria
                    DZOBJ_profile_img.removeFile(file);
                    toastr.error("Please upload an image with dimensions " + allowedWidth + "x" + allowedHeight + " pixels.");
                }
            };
            img.src = URL.createObjectURL(file);
        });

        DZOBJ_profile_img.on("sending", function (file, xhr, formData) {
            var nonce = document.getElementsByName("profile_image_nonce")[0].value;
            formData.append("action", "delicious_recipes_profile_image_upload");
            formData.append("nonce", nonce);
        });

        // Error or failure.
        DZOBJ_profile_img.on("error", function (file, response) {
            toastr.error('Image upload failed. Please try again.');
        });

        DZOBJ_profile_img.on("success", function (file, response) {
            if ( response.success ) {
                // Update profile image preview
                $('.dr-profile-img-holder img').attr('src', response.data.url);
                
                // Store attachment ID and url
                $('input[name="profile_image"]').val(response.data.id);
                $('input[name="profile_image_url"]').val(response.data.url);
            } else {
                toastr.error('Image upload failed. Please try again.');
                DZOBJ_profile_img.removeFile(file);
            }
        });

        DZOBJ_profile_img.on("addedfile", function (file) {
            thisDZContainer_profile_img.find(".dr-profile-img-delete").css("display", "block");
            thisDZContainer_profile_img.find(".dr-profile-img-delete").on("click", function (e) {
                thisDZContainer_profile_img.find("input[name='profile_image']").val('');
                thisDZContainer_profile_img.find("input[name='profile_image_url']").val('');
                DZOBJ_profile_img.removeFile(file);
                thisDZContainer_profile_img.find(".dr-profile-img-delete").css("display", "none");
            });
        });
    }

    $(document).on('click', '.dr-profile-btns .dr-profile-img-delete', function (e) {
        DZOBJ_profile_img.removeAllFiles();
        thisDZContainer_profile_img.find("input[name='profile_image']").val('');
        thisDZContainer_profile_img.find("input[name='profile_image_url']").val('');
        thisDZContainer_profile_img.find(".img img").remove();
        thisDZContainer_profile_img.find(".dr-profile-img-delete").css("display", "none");

    });

	$("form[name='dr-form__sign-up']").parsley();

})(jQuery)


function drUserRegistration() {
	jQuery("form[name='dr-form__sign-up']").parsley()
	jQuery("form[name='dr-form__sign-up']").trigger('submit');
};

function drUserPasswordLost() {
	jQuery("form[name='dr-form__lost-pass']").submit();
}

/**
 * Scroll to div metabox.
 */
function deluserdb_tab_scrolltop(drUniqueClass) {
    let viewHolder = document.querySelector('.dr-ud-' + drUniqueClass + '-content');
    viewHolder.scrollIntoView(true);
    return false;
}
