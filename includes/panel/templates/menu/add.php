<script>
    $( function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    } );
</script>
<h3>Gestionar menu lateral</h3>

<form>
    <div>
        <label></label>
    </div>

    <div>

    </div>
</form>


<ul id="sortable">
  <?php
  foreach ($lang["sidenav"] as $item)
  {
      ?>
      <li><?php echo $item["text"]?></li>
      <?php
  }
  ?>
</ul>

