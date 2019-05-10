<div class="container">
    <br>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="padding-bottom: 2px;padding-top: 2px;padding-right: 20px;padding-left: 20px;border-radius: 20px;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
          <li class="{{Request::is('/') ? 'nav-item active' : 'nav-item'}}">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="{{Request::is('products') ? 'nav-item active' : 'nav-item'}}">
            <a class="nav-link" href="/products">Cars</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
        </ul>
      </div>
</nav>
</div>