<div class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="inputEmail">State</label>
    <div class="controls">
      <input type="text" value="<?php echo $_POST['state']; ?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Citye</label>
    <div class="controls">
		<input type="text" value="<?php echo $_POST['city']; ?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Locality</label>
    <div class="controls">
      <input type="text" id="locality">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button class="btn btn-primary" onclick="submitLocation('<?php echo $_POST['state']; ?>','<?php echo $_POST['city']; ?>'); return false;">Select</button>
	  <button class="btn btn-primary" onclick="getStateAgain(); return false;" >All States</button>
    </div>
  </div>
</div>