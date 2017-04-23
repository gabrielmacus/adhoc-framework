
<header>
    <h2><?php echo $lang["hoyos"]?></h2>
</header>
<script>


    angular.element(function () {

        scope.hoyos = <?php echo json_encode($posts)?>;

        console.log(scope.hoyos);
        scope.$apply();

    });

</script>

<div class="body">

</div>
