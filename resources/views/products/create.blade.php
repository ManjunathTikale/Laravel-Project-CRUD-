<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Simple Laravel Crud</h3>
    </div>

    <div class="container">
    <div class="row justify-content-center mt-4">
        
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>

            </div>

        </div>
        <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Create Product</h3>
                </div>
                <form enctype= "multipart/form-data" action="{{ route('products.store') }}" method="post">
                    @csrf
                <div class="card-body">
                    <div class="col-md-10 mb-3">
                        <label for="name" class="form-label h5">Name</label>
                        <input value="{{ old('name')}}" type="text" class="form-control h4 form-control-lg @error('name') is-invalid @enderror" placeholder="Enter Name" name="name">
                        @error('name')
                         <p class="invalid-feedback">{{ $message }}</p>
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sku" class="form-label h5">Sku</label>
                        <input value="{{ old('sku')}}" type="text" class="form-control h4 form-control-lg @error('sku') is-invalid @enderror" placeholder="Sku" name="sku">
                        @error('sku')
                         <p class="invalid-feedback">{{ $message }}</p>
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label h5">Price</label>
                        <input value="{{ old('price')}}" type="text" class="form-control h4 form-control-lg @error('price') is-invalid @enderror" placeholder="Price" name="price">
                        @error('price')
                         <p class="invalid-feedback">{{ $message }}</p>
                         @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label h5">Description</label>
                        <textarea class="form-control" name="description" cols="30" rows="5" value="{{ old('description')}}"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label h5">Image</label>
                        <input type="file" class="form-control h4 form-control-lg" name="image">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        </div>
    </div>
  </body>
</html>
