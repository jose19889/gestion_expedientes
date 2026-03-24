<div class="alerts-area">

    <?php if (session()->getFlashdata('success')) : ?>
        <p class="text-success small" style="font-size:18px;"><?php echo session()->getFlashdata('success'); ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('danger') ) : ?>
        <p class="text-danger small-sms"> <?php echo session()->getFlashdata('danger'); ?></p>
    <?php endif; ?>
    </div>