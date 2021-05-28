<?php
require_once '../../core/init.php';

$fileUpload = new FileUpload();
$admin = new Admin();
$sermon = new Sermon();
$validate = new Validate();
$show = new Show();
if (isset($_POST['action']) && $_POST['action'] == 'fetchSermonTextForm') {
    $msg = $sermon->fetchSermon('sermonTextFormat');
    if ($msg) {
      $output = '';

      $output .= '
          <table class="table table-hover table-bordered table-stripped" id="showSermons">
          <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Sermon Date</th>
            <th>Date Posted</th>
            <th>Published</th>
            <th>Detail</th>
            <th>Delete</th>
          </tr>
          </thead>
          <tbody>
      ';
        foreach ($msg as $serm) {
          if ($serm->published == 0) {
            $show = '<button type="button" id="'.$serm->id.'" class="btn btn-sm btn-info publishSermonBtn"><i class="fa fa-plus fa-lg"></i>Publish</button>';
          }else{
            $show = '<button type="button" id="'.$serm->id.'" class="btn btn-sm btn-danger UnpublishSermonBtn"><i class="fa fa-minus fa-lg"></i>Unpublish</button>';
          }
          $output .='
              <tr>
              <td>'.$serm->id.'</td>
              <td>'.$serm->title.'</td>
              <td>'.$serm->author.'</td>
              <td>'.pretty_dates($serm->dateOfSermon).'</td>
              <td>'.pretty_dates($serm->datePosted).'</td>
              <td>'.$show.'</td>
              <td>
                <a href="detail/sermon-text/'.$serm->id.'" id="'.$serm->id.'" class="btn btn-sm btn-info viewDetailBtn"><i class="fa fa-info-circle fa-lg"></i>Details</button>
              </td>
              <td>
                <button type="button" id="'.$serm->id.'" class="btn btn-sm btn-danger deleteSermonBtn"><i class="fa fa-trash fa-lg"></i>Trash</button>
              </td>

              </tr>
          ';
        }

      $output .='
      </tbody>
  </table>
      ';

      echo $output;
    }else {
      echo '<h3 class="text-center text-muted lead">No Sermon yet</h3>';
    }
}


if (isset($_POST['action']) && $_POST['action'] == 'fetchSermonAuds') {
    $msg = $sermon->fetchSermon('sermonAudioFormat');
    if ($msg) {
      $output = '';

      $output .= '
          <table class="table table-hover table-bordered table-stripped" id="showSermonA">
          <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Sermon Date</th>
            <th>Audio File</th>
            <th>Date Posted</th>
            <th>Published</th>
            <th>Detail</th>
            <th>Delete</th>
          </tr>
          </thead>
          <tbody>
      ';
        foreach ($msg as $serm) {
          if ($serm->published == 0) {
            $show = '<button type="button" id="'.$serm->id.'" class="btn btn-sm btn-info publishSermonAudioBtn"><i class="fa fa-plus fa-lg"></i>Publish</button>';
          }else{
            $show = '<button type="button" id="'.$serm->id.'" class="btn btn-sm btn-danger UnpublishSermonAudioBtn"><i class="fa fa-minus fa-lg"></i>Unpublish</button>';
          }
          $output .='
              <tr>
              <td>'.$serm->id.'</td>
              <td>'.$serm->title.'</td>
              <td>'.$serm->author.'</td>
              <td>'.pretty_dates($serm->dateOfSermon).'</td>
              <td>
              <audio controls>
                  <source src="'.URLROOT.AUDIOPATH.$serm->audio.'" type="audio/mpeg">
                </audio>
              </td>
              <td>'.pretty_dates($serm->datePosted).'</td>
              <td>'.$show.'</td>
              <td>
                <a href="detail/sermon-audio/'.$serm->id.'" id="'.$serm->id.'" class="btn btn-sm btn-info"><i class="fa fa-info fa-lg"></i>Details</button>
              </td>
              <td>
                <button type="button" id="'.$serm->id.'" class="btn btn-sm btn-danger deleteAudioSermon"><i class="fa fa-trash fa-lg"></i>Trash</button>
              </td>

              </tr>
          ';
        }

      $output .='
      </tbody>
  </table>
      ';

      echo $output;
    }else {
      echo '<h3 class="text-center text-muted lead">No Sermon yet</h3>';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'addSermon') {

  if (Input::exists()) {
      $validation = $validate->check($_POST, array(
        'sermonTitle' => array(
            'required' => true
        ),
        'sermonAuthor' => array(
            'required' => true
        ),
        'datePreached' => array(
            'required' => true
        ),
        'sermon' => array(
            'required' => true
        ),
      ));
      if ($validation->passed()){
      $sermonTitle = Input::get('sermonTitle');
        $slug_url = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($sermonTitle)));
        //check and generate slug url for each sermon
             $checkSlug = $sermon->slugCheck('sermonTextFormat',$slug_url);
             if ($checkSlug) {
                 foreach ($checkSlug as $slug) {
                   $data[] = $slug->slug_url;
                 }
                 if (in_array($slug_url, $data)) {
                   $count = 0;
                   while(in_array(($slug_url . '-' . ++$count), $data));
                   $slug_url = $slug_url . '-' . $count;
                 }
             }

             //insert data
             try {
               $sermon->create('sermonTextFormat', array(
                 'author' => Input::get('sermonAuthor'),
                 'title' => Input::get('sermonTitle'),
                 'slug_url' => $slug_url,
                 'message' => Input::get('sermon'),
                 'dateOfSermon' => Input::get('datePreached'),
               ));
               echo 'success';
             } catch (\Exception $e) {
               echo $show->showMessage('danger', $e->getMessage(), 'warning');
               return false;
             }

      }else{
        foreach ($validation->errors() as $error) {
        echo $show->showMessage('danger', $error, 'warning');
        return false;
        }
      }
  }
}

if (isset($_POST['publishtext_id']) && !empty($_POST['publishtext_id'])) {
   $actionId = $_POST['publishtext_id'];
   $sermon->publishAction('sermonTextFormat', $actionId, 1);
}

if (isset($_POST['unpublishtext_id']) && !empty($_POST['unpublishtext_id'])) {
   $actionId = $_POST['unpublishtext_id'];
   $sermon->publishAction('sermonTextFormat', $actionId, 0);
}
if (isset($_POST['publishaudio_id']) && !empty($_POST['publishaudio_id'])) {
   $actionId = $_POST['publishaudio_id'];
   $sermon->publishAction('sermonAudioFormat', $actionId, 1);
}


if (isset($_POST['unpublishaudio_id']) && !empty($_POST['unpublishaudio_id'])) {
   $actionId = $_POST['unpublishaudio_id'];
   $sermon->publishAction('sermonAudioFormat', $actionId, 0);
}


if (isset($_POST['delserm_id']) && !empty($_POST['delserm_id'])) {
   $actionId = $_POST['delserm_id'];
   $check = $sermon->publishStatus('sermonTextFormat',$actionId);
   if ($check->published == 1) {
     echo $show->showMessage('danger', 'Please Unplublish this sermon from public before editing, to avoid errors', 'warning');
     return false;
   }
   $sermon->deleteAction('sermonTextFormat', $actionId, 1);
}


if (isset($_POST['delserma_id']) && !empty($_POST['delserma_id'])) {
   $actionId = $_POST['delserma_id'];
   $check = $sermon->publishStatus('sermonAudioFormat',$actionId);
   if ($check->published == 1) {
     echo $show->showMessage('danger', 'Please Unplublish this sermon from public before editing, to avoid errors', 'warning');
     return false;
   }

   $sermon->deleteAction('sermonAudioFormat', $actionId, 1);
}



if (isset($_POST['action']) && $_POST['action'] == 'recentPost') {
  $data = $sermon->fetchSermonFront();
  $output = '';
  if ($data) {
    foreach ($data as $r) {
      $output .= '
      <ul class="list-unstyled m-0">
      <a href="'.URLROOT.'sermon/read/'.$r->slug_url.'" class="page-link border-0" style="text-decoration:none;">
        <li class="media">
          <img data-src="'.URLROOT.'images/featured.png" class="img-thumbnail lazy" alt="'.$r->title.'" src="'.URLROOT.'images/featured.png" width="100">
          <div class="media-body ml-2">
            <h6 class="text-info mb-1">'.$r->title.'</h6>
            <p class="small text-muted m-0">
             By '.$r->author.'
            </p>
            <p class="small text-muted m-0">
              '.pretty_dates($r->datePosted).'
            </p>
          </div>
        </li>
      </a>
    </ul>';
    }
    echo $output;
  }else{
    echo '<h3 class="text-center text-secondary px-3"> No Recent Post Yet</h3>';
  }
}
