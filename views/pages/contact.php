<section class="vh-100 gradient-custom">
  <div class="py-5">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Send us a query!</h2>

            <form validate>
              <div class="form-group">
                <label for="userEmail">Your email:</label>
                <input type="email" class="form-control" id="userEmail" placeholder="Enter email" name="userEmail">
              </div>
              <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="subject" placeholder="Enter subject" name="subject">
              </div>
              <div class="form-group">
                <div id="email-body-editor">This is some sample content.</div>
              </div>
              <button type="submit" class="btn btn-default" name="send-query" id="send-query">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
$(document).ready(function() {
  let editor;

  ClassicEditor
    .create(document.querySelector('#email-body-editor'))
    .then(newEditor => {
      editor = newEditor;
    })
    .catch(error => {
      console.error(error);
    });

  $(document).on("submit", "form", (e) => {
    e.preventDefault();
    $.ajax({
      url: "api/contact.php",
      method: "POST",
      data: {
        userEmail: $("#userEmail").val(),
        subject: $("#subject").val(),
        body: editor.getData()
      },
      success: function(result) {
        alert(result);
      },
      error: function(err) {
        alert("Error!");
        console.log(err);
      }
    });
  });
});
</script>