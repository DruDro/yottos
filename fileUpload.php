<?php
require_once('../../../wp-load.php');
//print_r($_FILES) ;

if (isset($_FILES['files']) && !empty($_FILES['files']['name'])) {
    $allowedExts = array(
        "gif",
        "jpeg",
        "jpg",
        "png",
        "GIF",
        "JPEG",
        "JPG",
        "PNG",
        "DOC",
        "DOCX",
        "RTF",
        "TXT",
        "PDF"
    );
    $temp        = explode(".", $_FILES["files"]["name"]);
    $extension   = end($temp);
    if (in_array($extension, $allowedExts)) {
        if ($_FILES["files"]["error"] > 0) {
            $response = array(
                "status" => 'error',
                "message" => 'ERROR Return Code: ' . $_FILES["files"]["error"]
            );
        } else {
            $uploadedfile = $_FILES['files'];
            $upload_name  = $_FILES['files']['name'];
            $uploads      = wp_upload_dir();
            $filepath     = $uploads['path'] . "/$upload_name";

            if (!function_exists('wp_handle_upload')) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
            }
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $upload_overrides = array(
                'test_form' => false
            );
            $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
            if ($movefile && !isset($movefile['error'])) {

                $file = $movefile['file'];
                $url  = $movefile['url'];
                $type = $movefile['type'];

                $attachment = array(
                    'post_mime_type' => $type,
                    'post_title' => $upload_name,
                    'post_content' => 'Image for ' . $upload_name,
                    'post_status' => 'inherit'
                );

                $attach_id   = wp_insert_attachment($attachment, $file, 0);
                $attach_data = wp_generate_attachment_metadata($attach_id, $file);
                wp_update_attachment_metadata($attach_id, $attach_data);

            }

            $response = array(
                "status" => 'success',
                "url" => $filepath
            );

        }
    } else {
        $response = array(
            "status" => 'error',
            "url" => "",
            "message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini'
        );
    }
} else{
    $response = array(
            "url" => $filepath
   	);
}
print json_encode($response);
exit;
?>
