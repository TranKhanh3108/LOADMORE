<?php
include "config.php";
?>
<!doctype html>
<html>
    <head>
        <title>Load more data using jQuery,AJAX, and PHP</title>
        <link href="./style.css" type="text/css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="ajax.js"></script>
    </head>
    <body>
        <div class="container">

            <?php
            $rowperpage = 3;

            // counting total number of posts
            $allcount_query = "SELECT count(*) as allcount FROM posts";
            $allcount_result = mysqli_query($con,$allcount_query);
            $allcount_fetch = mysqli_fetch_array($allcount_result);
            $allcount = $allcount_fetch['allcount'];

            // select first 5 posts
            $query = "select * from posts order by id asc limit 0,$rowperpage ";
            $result = mysqli_query($con,$query);

            while($row = mysqli_fetch_array($result)){

                $id = $row['id'];
                $title = $row['title'];
                $content = $row['content'];
                $shortcontent = substr($content, 0, 160)."...";
                $link = $row['link'];
            ?>

                <div class="post" id="post_<?php echo $id; ?>">
                    <h2><?php echo $title; ?></h2>
                    <p>
                        <?php echo $shortcontent; ?>
                    </p>
                    <a href="'.$link.'" target="_blank" class="more">More</a>
                </div>

            <?php
            }
            ?>

            <h2 class="load-more">Load More</h2>
            <input type="hidden" id="row" value="0">
            <input type="hidden" id="all" value="<?php echo $allcount; ?>">

        </div>
    </body>
</html>