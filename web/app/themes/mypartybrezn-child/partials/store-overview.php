<?php
global $stores;
?>

<div class="row pt-5 pb-5 store-selection-wrapper">

<?php foreach ($stores as $store) {
    $active = (isset($_SESSION['store_name']) && $_SESSION['store_name'] == $store->store) ? 'active' : ''; ?>

    <div class="col-9 col-sm-6 col-lg-3 store-selection-item <?php echo $active ?>">
      <h3><?php echo $store->store ?></h3>
      <p>
        Maximarkt <?php echo $store->store ?><br />
        <?php echo $store->street ?><br />
        A-<?php echo $store->zip . ' ' . $store->place ?>
      </p>
      <input type="hidden" name="store-id" value="<?php echo $store->id ?>" />
    </div>
<?php
} ?>

</div>
