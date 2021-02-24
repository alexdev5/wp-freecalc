
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

<style>
   .footer{
      background: #18164A;
      line-height: 50px;
      font-size: 14px;
      height: 48px;
      margin-left: -8px;
      margin-right: -8px;
      padding-left: 80px;
      padding-right: 80px;
      color: #fff;
      vertical-align: middle;
      font-family: 'Open Sans', sans-serif;
   }
   .footer-left{
      float: left;
      vertical-align: middle;
   }
   .footer-right{
      float: right;
      vertical-align: middle;
   }
   .footer-left > *,
   .footer-right > *{
      vertical-align: middle;
   }
   b{
      font-weight: 600;
   }
</style>
<div class="footer">
	<div class="footer-left">
      <img src="<?= FREECALC_URL.'admin/img/pdf/phone.png' ?>">
      <span><?= htmlspecialchars_decode($setting['telephone-company']) ?></span>
   </div>
	<div class="footer-right">
      <img src="<?= FREECALC_URL.'admin/img/pdf/mail.png' ?>">
      <span><?= $setting['email-company'] ?></span>
   </div>
</div>

