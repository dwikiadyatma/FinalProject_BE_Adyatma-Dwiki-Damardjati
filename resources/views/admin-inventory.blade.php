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

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('add')}}">Tambahkan Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('show_item_inventory')}}">Katalog View</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('admin_view_invoices')}}">View Invoices</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('landing')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('shop')}}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('cart')}}">Cart</a>
                    </li>
                </ul>
            </div>
        </div> 
    </nav>
    <!-- Page -->
    <div class="container-xxl">
            <h1 class="display-6">Katalog Admin</h1>
            <h6>Tambahkan Barang <a href="{{route('add')}}">here</a></h6>
            <!-- Table display -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Barang #</th>
                    <th scope="col">Gambar Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- repeat per product -->
                    @foreach ($items as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td><img src="{{ asset('storage/item_images/'.$item->picture_path) }}" style=" height: 150px;"></td>
                            <td>{{$item->item_name}}</td>
                            <td>{{$item->item_quantity}}</td>
                            <td>Rp {{$item->item_price}}</td>
                            <td class="d-flex flex-column">
                                <a class="btn btn-warning" href="{{route('update_item', $item->id)}}" role="button" style="width: 6rem">Update</a>
                                <form action="{{route('delete_item', $item->id)}}" method="POST">
                                    @csrf
                                    @method('Delete')
                                    <button class="btn btn-danger" type="submit"  style="width: 6rem">Delete&nbsp</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>