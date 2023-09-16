class Header extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
    
     
    <nav id="navbari" class="navbar navbar-expand-lg spl-p  fixed-top navbar-light bg-light">
    <div class="container-fluid">
      <img style="cursor:pointer;" onclick="moveHome()" width="100px" src="images/Sadhana_logo2.png" alt="" >
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" style="margin-left:4%" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex justify-content-around me-auto mb-2 mb-lg-0 nav-fill">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="products.php">Home</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" aria-current="page" href="examples.html">Example</a>
        </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Products
            </a>
            <ul class="dropdown-menu nav-fill" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="pitch-deck.html">pitch decks</a></li>
              <li><a class="dropdown-item" href="sales-deck.html">sales decks</a></li>
              <li><a class="dropdown-item" href="finance-deck.html">finance decks</a></li>
              <li><a class="dropdown-item" href="cooperate-deck.html">corporate decks</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">Home</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="templates.html">Templates</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             Resources
            </a>
            <ul class="dropdown-menu nav-fill" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="resource1.html">white paper</a></li>
              <li><a class="dropdown-item" href="resource2.html">content sheet</a></li>
              <li><a class="dropdown-item" href="resource3.html">101 investor questions</a></li>
            </ul>
          </li>
        </ul>
          <!--<div class="d-none d-lg-flex  align-items-baseline ">
            <p class="text white mx-4">
                <span class="mx-2 phone-icon ">
                        <i class="fas fa fa-phone fa-fw"></i>8765439026</span>
            </p>
           </div>-->
        
           <div   class="nav-right1">
           <form  class="container-fluid justify-content-start ">
            <button type="button" onclick="moveAnother()" class="navbutton" style="background-color: #fa5255; color:white;font-size: 20px;">Order now</button>
          </form>
        </div>
    </div>
    </div>
  </nav>
      
      
    `;
  }
}

customElements.define('header-component', Header);