<header class="header">
  <div class="container header__inner">
    <a href="/" class="header__title">Docker PHP</a>

    <nav class="header__nav">
      <ul>
        <li><a href="/about">About</a></li>
        <li><a href="/contact">Contact</a></li>
      </ul>
    </nav>

    @include(
      '_components.ui.button',
      [
        'label' => '<i class="fa-regular"></i>',
        'variant' => 'ghost',
        'size' => 'icon',
        'class' => 'header__theme-toggle',
      ]
    )
  </div>
</header>

@resources('css/components/header.css')
@resources('js/components/header.js')
