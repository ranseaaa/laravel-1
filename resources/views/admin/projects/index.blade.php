<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Index - Admin</title>
        <link href="{{ asset('template-admin/css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="sb-nav-fixed">
        <x-navbar-full></x-navbar-full>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <x-navbar-admin></x-navbar-admin>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main class="ms-5">
                    <h1 class="mt-5">Projects</h1>
                    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Create Project</a>
                    <div class="card py-5 px-3">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th> <!-- Tambahkan kolom indeks -->
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Link</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> <!-- Gunakan $loop->iteration untuk indeks -->
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->description }}</td>
                                        <td><a href="{{ $project->link }}" target="_blank">{{ $project->link }}</a></td>
                                        <td>{{ $project->date }}</td>
                                        <td>
                                            <a href="{{ route('projects.show', $project) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="notifHapus(this)">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('template-admin/js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('template-admin/assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('template-admin/assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('template-admin/js/datatables-simple-demo.js') }}"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script>
            $(document).ready( function () {
                $('#dataTable').DataTable();
            } );
        </script>
        // Delete Notif
        <script>
            function notifHapus(button){
                Swal.fire({
                icon: 'info',
                title: 'info',
                text: 'Do you want delete this data??',
                showCancelButton: true,
                timer: 3000,
                showConfirmButton: true
            }).then((result)=>{
                if (result.isConfirmed){
                    button.parentElement.submit();
                }
            });
            }

            @if (session('delete'))
                Swal.fire({
                    title: 'Info',
                    text: 'Data has been deleted successfuly!',
                    icon: 'success'
                })
                
            @endif
        </script>

        // Data Notif
        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
        @endif

        <!-- SweetAlert Error Message -->
        @if($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'There were some errors. Please check your inputs.',
                });
            </script>
        @endif
    </body>
</html>
