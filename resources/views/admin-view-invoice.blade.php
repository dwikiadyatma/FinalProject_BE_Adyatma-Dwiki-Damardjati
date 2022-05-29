<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog</title>
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
                    @endauth
                    @if (Auth::user()->is_admin == true)
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('add')}}">Tambahkan Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('show_item_inventory')}}">Katalog View</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('admin_view_invoices')}}">View Invoices</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('landing')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('shop')}}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('cart')}}">Cart</a>
                    </li>
                    @guest
                    <a href="{{route('login')}}"><button class="btn btn-outline-success rounded-pill" type="submit">Login</button></a>
                    @endguest
                </ul>
            </div>
        </div> 
    </nav>
    <!-- Page -->
    <div class="container-fluid d-flex justify-content-center">
        <div class="container-xxl">
            <h1 class="display-6">Invoice Details</h1>
            <h5>Invoice Number: {{$invoice_data->id}}</h5>
            <!-- Table display -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Barang #</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Sub-total</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        
                    @foreach($invoice_items as $invoice_item)
                        <tr>
                            <th scope="row">{{$invoice_item->id}}</th>
                            <td>{{$invoice_item->item_name}}</td>
                            <td>{{$invoice_items_quantity[$loop->iteration - 1]->quantity}}</td>
                            <td>Rp {{$invoice_item->item_price}}</td>
                            <td>Rp {{$invoice_item->item_price * $invoice_items_quantity[$loop->iteration - 1]->quantity}}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <th colspan="4" class="text-end">Total: </td>
                            <td colspan="2">Rp {{$total}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            <form>
                <div class="mb-3">
                    <label for="adress" class="form-label">Alamat Pemesan</label>
                    <input type="text" class="form-control" id="address" name="address" disabled value="{{$invoice_data->address}}">
                </div>
                <div class="mb-3">
                    <label for="postcode" class="form-label">Kode Pos</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" disabled value="{{$invoice_data->address}}">
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>