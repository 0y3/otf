<!-- Modal -->
<div class="modal fade" id="deliveryLocateModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deliveryLocateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable dropdown-menu-right shadow-sm border-0">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">Select your delivery location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body ">
            <div class="homepage-search-form">
                <form class="form-noborder">
                <div class="form-row justify-content-center">
                    <div class="col-lg-10 col-md-10 col-sm-12 form-group">
                        <div class="location-dropdown">
                            <i class="icofont-location-arrow"></i>
                            <select class="custom-select form-control-lg locationselection select2" data-placeholder="Select your delivery location" name="delivery" value ="<?= !empty(getDeliveryLocationTemp()) ? $encrypter->decrypt(base64_decode(getDeliveryLocationTemp()['deliveryLocateId'])) : '' ?>" required>
                            <option value=""> Select your delivery location </option>
                            <?php foreach ($deliveryloc as $data) :?>
                            <?php if(getDeliveryLocationTemp()): ?>
                            <option value="<?=$data['id']?>" <?= ($data['id'] == $encrypter->decrypt(base64_decode(getDeliveryLocationTemp()['deliveryLocateId']))) ? 'selected' : '' ?> > <?= ucwords($data['city_name']) ?> <small>(<?= ucwords($data['state_name']) ?>)</small> </option>
                            <?php else: ?>
                            <option value="<?=$data['id']?>"> <?= ucwords($data['city_name']) ?> <small>(<?= ucwords($data['state_name']) ?>)</small> </option>
                            <?php endif; ?>
                            <?php endforeach;?>
                            </select>
                        </div>
                        <span class="badge badge-pill badge-warning error_loc"></span>
                        <!-- <input type="text" placeholder="Enter your delivery location" class="form-control form-control-lg">
                        <a class="locate-me" href="#"><i class="icofont-ui-pointer"></i> Locate Me</a> -->
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
