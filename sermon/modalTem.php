
    <div class="modal fade" id="showCommentBox">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-secondary">
                    <h4 class="modal-title text-light"><i class="fas fa-code fa-lg"></i>&nbsp; Source And Screen Details</h4>
                    <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body text-primary">
            <h4 class="text-dark">Drop Your comment</h4>
              <div class="container">
                <form method="post" id="comment_form">
                  <div class="form-group">
                    <input type="text" name="comment_sender_name" id="comment_sender_name" class="form-control" placeholder="Name">
                  </div>
                  <div class="form-group">
                    <input type="email" name="comment_sender_email" id="comment_sender_email" class="form-control" placeholder="Email" aria-describedby="comment_sender_email">
                    <small id="comment_sender_email" class="form-text text-muted">We'll never share your email with anyone else.</small>

                  </div>
                   <div class="form-group">
                     <textarea class="form-control" name="comment_content" id="comment_content" placeholder="Enter Comment" rows="5" autofocus>

                     </textarea>
                  </div>
                   <div class="form-group">
                      <input type="hidden" name="tut_id" id="tut_id" value="<?=$data['slug']->id ;?>">
                     <input type="hidden" name="comment_id" id="comment_id" value="0">
                    <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Comment">
                  </div>
                </form>
                <span id="comment_message"></span> <br>
                <div id="display_comment">
                </div>
              </div>
                  </div>
                </div>


              </div>
            </div>