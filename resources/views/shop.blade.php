<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaraShop</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css -->
    
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Katalog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::user()->name}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                    </li>
                    
                    @if (Auth::user()->is_admin == true)
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('add')}}">Tambahkan Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('show_item_inventory')}}">Katalog View</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('admin_view_invoices')}}">View Invoices</a>
                    </li>
                    
                    @endif
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{route('cart')}}">Cart</a>
                    </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('landing')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('shop')}}">Shop</a>
                    </li>
                    
                    @guest
                    <a href="{{route('login')}}"><button class="btn btn-outline-success rounded-pill" type="submit">Login</button></a>
                    @endguest
                </ul>
            </div>
        </div> 
    </nav>
    <!-- Page -->
    <div class="container-xxl">
        <h1 class="display-6 text-center">Shop</h1>
        <div class="container-lg d-flex flex-wrap justify-content-center">
            <!-- Item cards -->

            <!-- <div class="card m-2" style="width: 12rem;">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title">Item 1</h5>
                    <p class="card-text">Rp 9.999,00</p>
                    <a href="#" class="btn btn-primary">Add to Cart</a>
                </div>
            </div> -->

            @foreach ($items as $item)
                <div class="card m-2" style="width: 12rem;">
                    <img src="{{ asset('storage/item_images/'.$item->picture_path) }}" class="card-img-top" alt="Product Image" style="width: 100%; height: 150px; margin-left: auto; margin-right: auto;">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->item_name}}</h5>
                        <p class="card-text">Rp {{$item->item_price}}</p>
                        <a href="{{route('add_cart', $item->id)}}" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>