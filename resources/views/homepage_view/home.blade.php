@extends('homelayout.layout')

@section('title')
    Home Page
@endsection

@section('content')
    <div class="container">
        <div class="row">   
            @if (Auth::user()->role_id == 1)       
                <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <div class="card">                   
                        <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <div class="d-flex justify-content-end mb-3 mb-md-0">
                                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addTestCaseModal">
                                    Add Test Case
                                </button>
                            </div>
                            <div class="input-group" style="max-width: 300px;">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                            </div>
                            <div class="mt-3 mt-md-0">
                                <form action="{{ route('home.deleteAllTestCase') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete all test cases?')">Delete All</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x: auto;">                           
                            @if ($data_testcase->isEmpty())
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading text-center">No Data</h4>
                                    <p class="text-center">There is no data</p>
                                </div>
                            @else
                                <table class="table table-striped" id="tableTestCase">
                                    <thead>
                                        <tr>
                                        <th scope="col">Test Domain</th>
                                            <th scope="col">Function</th>
                                            <th scope="col">Test Case Name</th>
                                            <th scope="col">Test Case Description</th>
                                            <th scope="col">Test Case Type</th>
                                            <th scope="col">Test Case Step</th>
                                            <th scope="col">Expected Result</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data_testcase as $testcase)
                                        <tr>
                                            <td>{{$testcase->test_domain}}</td>
                                            <td>{{$testcase->function_apps}}</td>
                                            <td>{{$testcase->test_case_name}}</td>
                                            <td>{{$testcase->test_case_description}}</td>
                                            <td>
                                                @if($testcase->test_case_type)
                                                    <span class="badge bg-success">Positive</span>
                                                @else
                                                    <span class="badge bg-danger">Negative</span>
                                                @endif
                                            </td>
                                            <td><pre>{{$testcase->test_step}}<pre></td>
                                            <td>{{$testcase->expected_result}}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <form method="POST" action="{{ route('home.deleteTestCase', $testcase->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Are you sure you want to delete this?')"><i
                                                            class="fas fa-trash"></i></button>
                                                    </form>
                                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTestCaseModal{{$testcase->id}}"><i 
                                                            class="fas fa-edit"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editTestCaseModal{{$testcase->id}}" tabindex="-1" aria-labelledby="editTestCaseModal{{$testcase->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editTestCaseModal{{$testcase->id}}">Edit Test Case</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST" action="{{ route('home.editTestCase', $testcase->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="test_domain{{$testcase->id}}">Edit Test Domain</label>
                                                                <textarea id="test_domain{{$testcase->id}}" name="test_domain" class="form-control" required>{{ $testcase->test_domain }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="function_apps{{$testcase->id}}">Edit Function</label>
                                                                <textarea id="function_apps{{$testcase->id}}" name="function_apps" class="form-control" required>{{ $testcase->function_apps }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="test_case_name{{$testcase->id}}">Edit Test Case Name</label>
                                                                <textarea id="test_case_name{{$testcase->id}}" name="test_case_name" class="form-control" required>{{ $testcase->test_case_name }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="test_case_description{{$testcase->id}}">Edit Test Case Description</label>
                                                                <textarea id="test_case_description{{$testcase->id}}" name="test_case_description" class="form-control" required>{{ $testcase->test_case_description }}</textarea>
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label for="test_case_type{{$testcase->id}}">Edit Test Case Type</label>
                                                                <select class="form-select" id="test_case_type{{$testcase->id}}" name="test_case_type" required>
                                                                    <option value="1" {{ $testcase->test_case_type ? 'selected' : '' }}>Positive</option>
                                                                    <option value="0" {{ !$testcase->test_case_type ? 'selected' : '' }}>Negative</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="test_step{{$testcase->id}}">Edit Test Step</label>
                                                                <textarea id="test_step{{$testcase->id}}" name="test_step" class="form-control" required>{{ $testcase->test_step }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="expected_result{{$testcase->id}}">Edit Expected Result</label>
                                                                <textarea id="expected_result{{$testcase->id}}" name="expected_result" class="form-control" required>{{ $testcase->expected_result }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">  
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                            <div class="input-group mb-3" style="max-width: 200px;">
                                <label class="input-group-text" for="filterType">Filter</label>
                                    <select class="form-select" id="filterType">
                                        <option value="default">Default</option>
                                        <option value="test_domain_aplikasi">Test Domain</option>
                                        <option value="function_aplikasi">Function</option>
                                        <option value="module">Test Case Name</option>
                                    </select>
                            </div>
                            <div class="input-group mb-3" style="max-width: 200px;">
                                <label class="input-group-text" for="filterValue">List Filter</label>
                                <select class="form-select" id="filterValue" disabled></select>
                            </div>
                            <div class="input-group mb-3" style="max-width: 200px;">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="sortAlphabetically">
                                    Sort Alphabet
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x: auto;">
                            @if ($data_testcase->isEmpty())
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading text-center">No Data</h4>
                                    <p class="text-center">There is no data</p>
                                </div>
                            @else
                                <table class="table table-striped" id="tableTestCase">
                                    <thead>
                                        <tr>                
                                            <th scope="col">Test Domain</th>
                                            <th scope="col">Function</th>
                                            <th scope="col">Test Case Name</th>
                                            <th scope="col">Test Case Description</th>
                                            <th scope="col">Test Case Type</th>
                                            <th scope="col">Test Step</th>
                                            <th scope="col">Expected Result</th>                                              
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data_testcase as $testcase)
                                            <tr>                                       
                                                <td>{{$testcase->test_domain}}</td>
                                                <td>{{$testcase->function_apps}}</td>
                                                <td>{{$testcase->test_case_name}}</td>
                                                <td>{{$testcase->test_case_description}}</td>
                                                <td>
                                                    @if($testcase->test_case_type)
                                                        <span class="badge bg-success">Positive</span>
                                                    @else
                                                        <span class="badge bg-danger">Negative</span>
                                                    @endif
                                                </td>
                                                <td><pre>{{$testcase->test_step}}<pre></td>
                                                <td>{{$testcase->expected_result}}</td>                       
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <button id="scrollToBottomBtn" class="btn btn-primary btn-sm" style="position: fixed; bottom: 20px; right: 20px; display: none;">
        <i class="fas fa-chevron-down"></i>
    </button>
    <button id="scrollToTopBtn" class="btn btn-primary btn-sm" style="position: fixed; bottom: 60px; right: 20px; display: none;">
        <i class="fas fa-chevron-up"></i>
    </button>

    {{-- Modal Add Test Case --}}
    <div class="modal fade" id="addTestCaseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Test Case</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('home.addTestCase') }}" method="post" >
                        @csrf
                        <div class="mb-3">
                            <label for="test_domain" class="form-label">Test Domain</label>
                            <input type="text" class="form-control" id="test_domain" name="test_domain" required>
                        </div>
                        <div class="mb-3">
                            <label for="function_apps" class="form-label">Function</label>
                            <input type="text" class="form-control" id="function_apps" name="function_apps" required>
                        </div>
                        <div class="mb-3">
                            <label for="test_case_name" class="form-label">Test Case Name</label>
                            <input type="text" class="form-control" id="test_case_name" name="test_case_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="test_case_description" class="form-label">Test Case Description</label>
                            <textarea class="form-control" id="test_case_description" name="test_case_description" required> </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="test_case_type" class="form-label">Test Case Type</label>
                            <select class="form-select" id="test_case_type" name="test_case_type" required>
                                <option value="1">Positive</option>
                                <option value="0">Negative</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="test_step" class="form-label">Test Step</label>
                            <textarea class="form-control" id="test_step" name="test_step" required> </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="expected_result" class="form-label">Expected Result</label>
                            <input type="text" class="form-control" id="expected_result" name="expected_result" required>
                        </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<script>
$(document).ready(function () {
    var data = {!! json_encode($data_testcase) !!};

    $('#searchInput').on('keyup', function () {
        var searchText = $(this).val().toLowerCase();
        filterData(searchText);
    });

    $('#filterType').change(function () {
        var selectedFilter = $(this).val();
        if (selectedFilter === 'default') {
            $('#filterValue').empty().attr('disabled', true);
            filterData('');
            $('#sortAlphabetically').attr('disabled', false);
        } else if (selectedFilter === 'module' || selectedFilter === 'function_aplikasi' || selectedFilter === 'test_domain_aplikasi') {
            populateFilterOptions(selectedFilter);
            $('#filterValue').attr('disabled', false).val('').focus();
            $('#sortAlphabetically').attr('disabled', true);
        }
    });

    $('#filterValue').change(function () {
        var filterValue = $(this).val();
        filterDataByFilterValue(filterValue);
    });

    $('#sortAlphabetically').click(function () {
        sortDataAlphabetically();
    });

    function populateFilterOptions(filterType) {
        var options = [];
        var select = $('#filterValue');
        select.empty().attr('disabled', true);

        if (filterType === 'module') {
            options = [...new Set(data.map(item => item.test_case_name))];
        } else if (filterType === 'function_aplikasi') {
            options = [...new Set(data.map(item => item.function_apps))];
        } else if (filterType === 'test_domain_aplikasi') {
            options = [...new Set(data.map(item => item.test_domain))];
        }

        $.each(options, function (index, value) {
            select.append('<option value="' + value + '">' + value + '</option>');
        });
        select.attr('disabled', false);
    }

    function filterData(searchText) {
        var filterType = $('#filterType').val();
        var filterValue = $('#filterValue').val().toLowerCase();
        var dataRows = $('tbody tr');

        dataRows.each(function () {
            var rowText = $(this).text().toLowerCase();
            var showRow = true;

            if (searchText !== '') {
                showRow = rowText.indexOf(searchText) > -1;
            }

            if (filterType === 'module' && filterValue !== '') {
                var testCaseText = $(this).find('td:eq(2)').text().toLowerCase(); // Index 2 for test case name
                showRow = showRow && testCaseText.includes(filterValue);
            } else if (filterType === 'function_aplikasi' && filterValue !== '') {
                var functionText = $(this).find('td:eq(1)').text().toLowerCase(); // Index 1 for function
                showRow = showRow && functionText.includes(filterValue);
            } else if (filterType === 'test_domain_aplikasi' && filterValue !== '') {
                var testDomainText = $(this).find('td:eq(0)').text().toLowerCase(); // Index 0 for test domain
                showRow = showRow && testDomainText.includes(filterValue);
            }

            $(this).toggle(showRow);
        });
    }

    function filterDataByFilterValue(filterValue) {
        var searchText = $('#searchInput').val().toLowerCase();
        filterData(searchText);
    }

    function checkBottom() {
        var tableHeight = $('#tableTestCase').height();
        var scrollPosition = $(window).scrollTop();
        var windowHeight = $(window).height();

        if (scrollPosition === 0) { // Jika sudah di bagian paling atas
            $('#scrollToBottomBtn').fadeIn(); // Tampilkan "Scroll to Bottom"
            $('#scrollToTopBtn').fadeOut(); // Sembunyikan "Scroll to Top"
        } else if (scrollPosition + windowHeight >= tableHeight) { // Jika sudah di bagian paling bawah
            $('#scrollToBottomBtn').fadeOut(); // Sembunyikan "Scroll to Bottom"
            $('#scrollToTopBtn').fadeIn(); // Tampilkan "Scroll to Top"
        } else {
            $('#scrollToBottomBtn').fadeIn();
            $('#scrollToTopBtn').fadeOut();
        }
    }

    checkBottom();

    $(window).scroll(function () {
        checkBottom();
    });

    $('#scrollToBottomBtn').click(function () {
        var tableHeight = $('#tableTestCase').height();
        $('html, body').animate({ scrollTop: tableHeight }, 'slow');
    });

    $('#scrollToTopBtn').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });

    function sortDataAlphabetically() {
        var rows = $('#tableTestCase tbody').find('tr').get();
        rows.sort(function (a, b) {
            var keyA = $(a).children('td').eq(2).text(); // Index 2 for test case name
            var keyB = $(b).children('td').eq(2).text(); // Index 2 for test case name
            return keyA.localeCompare(keyB);
        });
        $.each(rows, function (index, row) {
            $('#tableTestCase').children('tbody').append(row);
        });
    }
});
</script>

@endsection
