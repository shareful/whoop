<?php
function getImage($imageName = '', $imageType)
{
    $imageUrl = getImageUrl($imageName, $imageType);
    $image = '<img class="image" src="' . $imageUrl . '" width="200"><br><a class="btn btn-danger btn-sm icon-only white deleteimage" href="javascript:void(0);" data-type="' . $imageType . '"><i class="fa fa-times "></i></a>';
    echo $image;
}

function getVideo($imageName = '', $imageType)
{
    $imageUrl = getImageUrl($imageName, $imageType);
    $video = '<video class="video" width="320" height="240" controls><source src="' . $imageUrl . '" type="video/mp4"></video><br><a class="btn btn-danger btn-sm icon-only white deletevideo" href="javascript:void(0);" data-type="' . $imageType . '"><i class="fa fa-times "></i></a>';
    echo $video;
}

function getImageUrl($imageName, $imageType)
{
    if ($imageName === '') {
        return getImagePlaceholderUrl();
    }
    if (file_exists(public_path() . '/upload/' . $imageType . '/' . $imageName)) {
        return asset('upload/' . $imageType . '/' . $imageName);
    } else {
        return getImagePlaceholderUrl();
    }
}

function getImagePlaceholderUrl()
{
    return url('/assets/img/no-image.png');
}

function displayDeleteForm($route)
{
    $form = '<form class="deleteForm" method="post" action="' . $route . '" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">' .
        csrf_field()
        . '<button id="submit" class="btn btn-danger btn-xs">
            <i class="fa fa-trash-o"></i> Delete
        </button>
    </form>';
    return $form;
}