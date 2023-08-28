<?php
   
    include "models/posts.php";
  
    adminOnly(); 
   
?>


     
<section class="vh-100 gradient-custom">
    <div class="container">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="index.php?page=create-post" class="btn btn-success">Add Post</a>
                            <a href="index.php?page=index-post" class="btn btn-success">Manage Posts</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Edit Post</h2>
                        <?php include "models/formErrors.php"; ?>
                        <form action="index.php?page=edit-post" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id ?>"/>
                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" class="form-control" name="title" value="<?php echo $title; ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" name="content" id="content" rows="8"><?php echo $content; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="image" class="form-control-file" name="image" />
                            </div>
                            <div class="form-group">
                                <label for="topic" class="form-label">Topic</label>
                                <select name="topic_id" class="form-control" id="topic">
                                    <option value=""></option>
                                    <?php foreach($topics as $key => $topic): ?>
                                        <?php if(!empty($topic_id) && $topic_id == $topic['id']): ?>
                                            <option selected value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-check mb-3">
                                <?php if(empty($published) && $published == 0): ?>
                                    <input class="form-check-input" type="checkbox" name="published" id="publish" value="1">
                                    <label class="form-check-label" for="publish">
                                        Publish
                                    </label>
                                <?php else: ?>
                                    <input class="form-check-input" type="checkbox" name="published" id="publish" value="1" checked>
                                    <label class="form-check-label" for="publish">
                                        Publish
                                    </label>
                                <?php endif; ?>
                            </div>
                            <button class="btn btn-success btn-block" name="update-post" type="submit">Update post</button>
                        </form>
                        <div id="rezultat"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



