<style type="text/css">
	.alert{
		margin-top: 5px;
	}
</style>
        <?php if(session()->getFlashdata('error')){ ?>
        
        <div class="alert alert-danger alert-rounded"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> </button>
            <?=session()->getFlashdata('message')?>
        </div>
                                
        <?PHP } ?>

        <?php if (session()->has('errors')) : ?>
            <div class="alert alert-danger alert-rounded">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">×</span> </button>
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        
        <?php if(session()->getFlashdata('warning')){ ?>
        <div class="alert alert-warning alert-rounded"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> </button>
            <?=session()->getFlashdata('message')?>
        </div>
        <?PHP } ?>
        
        <?php if(session()->getFlashdata('info')){ ?>
        <div class="alert alert-info alert-rounded">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> </button>
            <?=session()->getFlashdata('message')?>
        </div>
        <?PHP } ?>
        
        <?php if(session()->getFlashdata('success')){ ?>
        <div class="alert alert-success alert-rounded">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> </button>
            <?=session()->getFlashdata('message')?>
        </div>
        <?PHP } ?>
        
        <?php if(session()->getFlashdata('feedback')){ ?>
        <div class="alert alert-info alert-rounded">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> </button>
            <?=session()->getFlashdata('message')?>
        </div>
        <?PHP } ?>
        
        
        <?php if(isset($msg_error)){ ?>
        
            
            
        <div class="alert alert-danger alert-rounded"> 
            <?=$msg_error?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> </button>
        </div>
        
        <?PHP } ?>
        
        <?php if(isset($msg_flash)){ ?>
        
        <div class="alert alert-info alert-rounded"> 
            <?=$msg_flash?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> </button>
        </div>
        <?PHP } ?>