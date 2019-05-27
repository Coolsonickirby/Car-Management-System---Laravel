<div class="container">
    <br>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="padding-bottom: 2px;padding-top: 2px;padding-right: 20px;padding-left: 10px;border-radius: 20px;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="outline: 0;margin-left: -15px;">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
          <li class="{{Request::is('/') ? 'nav-item active' : 'nav-item'}}">
            <a class="nav-link" href="/" style="outline: 0;">Home</a>
          </li>
          <li class="{{Request::is('products') ? 'nav-item active' : 'nav-item'}}">
            <a class="nav-link" href="/products" style="outline: 0;">Cars</a>
          </li>
          <li class="{{Request::is('about') ? 'nav-item active' : 'nav-item'}}">
            <a class="nav-link" href="/about" style="outline: 0;">About</a>
          </li>
        </ul>
      </div>
</nav>
</div>