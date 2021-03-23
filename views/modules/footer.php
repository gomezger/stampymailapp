        <script src="<?php echo constant('URL'); ?>public/libs/bootstrap/dist/js/bootstrap.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <?php
    foreach ($jsFiles as $file) {
        echo '<script src="' . constant('URL') . 'public/js/' . $file . '">';
    }
    ?>
    </body>
</html>