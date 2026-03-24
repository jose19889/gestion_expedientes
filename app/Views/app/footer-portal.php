
  <!-- Footer -->
  <footer id="footer" class="footer light-background">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-6 footer-links">
            <h4 class="" style="margin-left: 80px;">Colaboradores</h4>
            <div class="colaboradores mt-4">
              <a href=""><img class="img-colabo" src="assets/img/Logos/logotct.png" alt="" data-aos="fade-in"></a>
            </div>
          </div>

          <div class="col-lg-4 col-6 footer-links">
            <h4>Enlaces Utiles</h4>
            <ul>
              <li><a href="#">Ministerio de Transportes</a></li>
              <li><a href="#">Primatura del Gobierno</a></li>
              <li><a href="#">Funcion Pública</a></li>
              <li><a href="#">Ministerio de trabajo</a></li>
              <li><a href="#">Ministerio de Asuntos exteriores</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-12 footer-contact text-center text-md-start">
            <h4>Dirección</h4>
            <p>Malabo II / Primatura</p>
            <p class="mt-4"><strong>Teléfono:</strong><br>
              <span>+240 222 104 010</span><br>
              <span>+240 555 104 010</span>
            </p>
            <p><strong>Email:</strong> <span>info@corrupcion.gob.gq</span></p>
          </div>
        </div>
      </div>
    </div>

    <div class="footer light-background">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-3 col-6 footer-links">
            <a href=""><img class="img-colabo" src="<?= base_url('plugins/portal-assets/img/logos/ortel.png') ?>" alt="" data-aos="fade-in"></a>
          </div>
          <div class="col-lg-3 col-6 footer-links">
            <a href=""><img class="img-colabo" src="<?= base_url('plugins/portal-assets/img/logos/gitge.png') ?>" alt="" data-aos="fade-in"></a>
          </div>
          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <a href=""><img class="img-colabo" src="<?= base_url('plugins/portal-assets/img/logos/getesa.png') ?>g" alt="" data-aos="fade-in"></a>
          </div>
          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <a href=""><img class="img-colabo" src="<?= base_url('plugins/portal-assets/img/logos/muni.png') ?>" alt="" data-aos="fade-in"></a>
          </div>
        </div>
      </div>
    </div>

    <div class="container copyright text-center">
      <div class="credits">
        <img src="assets/img/logo_dark.png" alt="" data-aos="fade-in">
      </div>
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Línea de anticorrupción</strong> <span>Todos los Derechos Reservados</span></p>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- JS Files -->
  <script src="<?php echo base_url();?>plugins/portal-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>plugins/portal-assets/vendor/aos/aos.js"></script>
  <script src="<?php echo base_url(); ?>plugins/portal-assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?php echo base_url(); ?>plugins/portal-assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>plugins/portal-assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="<?php echo base_url(); ?>plugins/portal-assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url(); ?>plugins/portal-assets/js/main.js"></script>

  <!-- Google Translate -->
<script type="text/javascript">
  // Google Translate configuration
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'es',
      includedLanguages: 'es,en,fr,pt',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
      autoDisplay: false
    }, 'google_translate_element');
  }

</script>


  
  <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <style>
    /* Container for the language selector */
    .language-selector {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-left: 15px;
      cursor: pointer;
      color: white;
      font-weight: 600;
      font-size: 14px;
      user-select: none;
      z-index: 9999;
    }

    /* Translate icon styling */
    .language-selector .bi-translate {
      font-size: 18px;
      color: white;
      transition: color 0.3s ease;
    }

    .language-selector:hover .bi-translate {
      color: #ffd700; /* gold color on hover */
    }

    /* Hide Google Translate default branding & styles but keep dropdown arrow */
    .goog-te-gadget span:not(.language-label),
    .goog-te-banner-frame,
    .goog-logo-link {
      display: none !important;
    }

    .goog-te-gadget {
      color: transparent !important;
      font-size: 0 !important; /* hide any extra text */
    }

    body > .goog-te-spinner-pos {
      display: none !important;
    }

    /* Style the Google Translate dropdown */
    #google_translate_element select {
      background: transparent;
      border: none;
      color: white;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      padding: 2px 6px;
      border-radius: 4px;
      outline: none;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      /* Add subtle arrow */
      background-image:
        linear-gradient(45deg, transparent 50%, white 50%),
        linear-gradient(135deg, white 50%, transparent 50%);
      background-position:
        calc(100% - 15px) calc(1em + 2px),
        calc(100% - 10px) calc(1em + 2px);
      background-size: 5px 5px;
      background-repeat: no-repeat;
    }

    /* On focus highlight */
    #google_translate_element select:focus {
      outline: 2px solid #ffd700;
      outline-offset: 2px;
    }

  </style>
</body>
</html>
