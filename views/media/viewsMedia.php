<?php
    $media->title = $_GET['n'];
    $m = $media->get();
?>
<style>
    #view-media p{
        font-size: var(--font-size-sm);
        margin: 10px auto;
    }

    #view-media .images{
        display: flex;
        flex-wrap: wrap;
    }
</style>
<div id="view-media">
    <h1><?= $m["title"] ?></h1>
    <p><?= $m["body"] ?></p>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(nicEditors.allTextAreas);
</script>
<textarea name="" rows="10" cols="109" id=""></textarea>
    <div class="images">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Nature_landscape.jpg/640px-Nature_landscape.jpg" alt="Nature Landscape">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Cute_dog.jpg/320px-Cute_dog.jpg" alt="Dog">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/NASA_Hubble_Telescope_View_of_Galaxy.jpg/800px-NASA_Hubble_Telescope_View_of_Galaxy.jpg" alt="Galaxy">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/Big_Ben_2012-04.jpg/400px-Big_Ben_2012-04.jpg" alt="Big Ben">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4e/Pink_flower_closeup.jpg/500px-Pink_flower_closeup.jpg" alt="Flower">

    </div>
</div>