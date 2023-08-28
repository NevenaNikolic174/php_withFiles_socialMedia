<?php

include "models/posts.php";

adminOnly(); 

$topics = selectAll('topics');
?>
<section class="vh-100 gradient-custom">
    <div class="py-5">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Add Post</h2>

                        <?php include "models/formErrors.php"; ?>
                        <form action="index.php?page=create-post" method="post" enctype="multipart/form-data" novalidate>


                        
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($title) ? $title : ''; ?>" required>
                                <label for="title">Title</label>
                            </div>

                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="content" name="content" rows="8" required><?php echo isset($content) ? $content : ''; ?></textarea>
                                <label for="content">Content</label>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            <div class="form-floating mb-3">
                                <label for="topic_id">Topic</label>
                                <select class="form-select" id="topic_id" name="topic_id" required>
                                    <option value="">Select a topic</option>
                                    <?php foreach ($topics as $key => $topic): ?>
                                        <?php if (!empty($topic_id) && $topic_id == $topic['id']): ?>
                                            <option value="<?php echo $topic['id'] ?>" selected><?php echo $topic['name'] ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="published" name="published" <?php echo !empty($published) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="published">Publish</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-lg" type="submit" name="add-post">Add post</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="index.php?page=index-post" class="btn btn-secondary">Manage Posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
