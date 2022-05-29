<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
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
            <a class="navbar-brand" href="#">Inventory</a>
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
                        <a class="nav-link" aria-current="page" href="{{route('add')}}">Add Item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('show_item_inventory')}}">Inventory View</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('admin_view_invoices')}}">View Invoices</a>
                    </li>
                    
                    @endif
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('cart')}}">Cart</a>
                    </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('landing')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('shop')}}">Shop</a>
                    </li>
                    
                    @guest
                    <a href="{{route('login')}}"><button class="btn btn-outline-success rounded-pill" type="submit">Login</button></a>
                    @endguest
                </ul>
            </div>
        </div> 
    </nav>
    <!-- Page -->
    <div class="container-xxl d-flex flex-column align-items-center justify-content-center" style="height: calc(100vh - 56px)">
        <h1 class="display-6 text-center">Edit Cart Item</h1>
        <div class="container" style="width: 24rem">
        <form method="POST" action="{{route('cart_editing', $cart_item->id)}}">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="itemName" class="form-label">Item Name</label>
                <input type="text" class="form-control" disabled id="item_name" name="item_name" aria-describedby="itemNameHelp" value="{{ $cart_item->Item()->first()->item_name }}">
            </div>
            <div class="mb-3">
                <label for="itemPrice" class="form-label">Item Price in Rp</label>
                <input type="text" class="form-control" disabled id="itemPrice" name="item_price" value="{{ $cart_item->Item()->first()->item_price }}">
            </div>
            <div class="mb-3">
                <label for="itemNumber" class="form-label">Item Ammount</label>
                <input type="number" class="form-control" id="itemNumber" name="quantity" value="{{ $cart_item->quantity }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Item</button>
            </form>
        </div>
    </div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>