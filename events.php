<title>Events</title>
<?php
$currentPage = 'events';
require_once './header.php'; ?>
<?php
$msg = "";
if (isset($_REQUEST["msg"])) {
    if ($_REQUEST["msg"] == 1) {
        $msg = "Thanks for contacting!";
    } else if ($_REQUEST["msg"] == 2) {
        $msg = "Event Added Successfully!";
    } else if ($_REQUEST["msg"] == 3) {
        $msg = "Event has been deleted!";
    } else if ($_REQUEST["msg"] == 4) {
        $msg = "Event has been updated!";
    }
}
if (!empty($msg)) {
    echo "<div class='alert alert-success alert-dismissible fade show'>
    <button class='close' data-dismiss='alert'>&times;</button>
    <strong>NSS CCEM</strong> $msg
    </div>";
}
?>
<?php
if (is_admin()) {
    // echo "<a href='./event_add.php' class='btn btn-dark text-white my-3'>Add New Event</a>";
?>
<br clear="all">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eventModal">
    Add New Event
</button>
<?php
}
?>
<h1 class="myhead1">Upcoming Events</h1>
<hr>
<table class="table table-bordered table-striped" id="resShowUp" style="width:100%">
    <thead class="bg-info text-white">
        <tr>
            <th>Event</th>
            <th>Organizer</th>
            <th>Date</th>
            <th>Contact No</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
        <tr>
            <th>Event</th>
            <th>Organizer</th>
            <th>Date</th>
            <th>Contact No</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<h1 class="myhead1" style="background-color: green">Previous Events</h1>
<hr>
<table class="table table-bordered table-striped" id="resShowPre">
    <thead class="bg-danger text-white">
        <tr>
            <th>Event</th>
            <th>Organizer</th>
            <th>Date</th>
            <th>Contact No</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $whr = "where CURDATE()>e_date";
        if (!empty($_REQUEST["si"])) {
            $whr = " where e_name like '%$_REQUEST[si]%'";
        }
        $query = "select * from events $whr order by eid desc ";
        $res = run_sql($query);
        while ($row = mysqli_fetch_array($res)) {
            echo "    <tr>
        <td>$row[e_name]</td>
        <td>$row[e_organizor]</td>
        <td>$row[e_date]</td>
        <td>$row[phone_no]</td>
        <td id='del'><a class='btn btn-sm btn-dark' href='event_det.php?id=$row[eid]'>Read More</a></td>
    </tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Event</th>
            <th>Organizer</th>
            <th>Date</th>
            <th>Contact No</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<!-- search ajax -->
<script>
$(document).ready(function() {
    $("#searchBox").keyup(function(e) {
        var target = "event_search.php";
        var name = $("#searchBox").val();
        $.get(target, {
            searchValue: name
        }, function(data, status) {
            $("#resShow").html(data);
            // alert(status)
        });

    });

});
</script>
<script>
// FOR JS DATA TABLE
var admin = "<?php echo $_SESSION['role'];  ?>";
if (admin == 'admin') {
    $("#resShowUp").DataTable({
        "bProcessing": true,
        "sAjaxSource": "ajax_table.php",
        "aoColumns": [{
                mData: 'e_name'
            },
            {
                mData: 'e_organizor'
            },
            {
                mData: 'e_date'
            },
            {
                mData: 'phone_no'
            },
            {
                "mRender": function(data, type, full) {
                    // console.log(full);
                    return `<a href="#add" id="${full[0]}" title="Edit" data-toggle="tooltip" > <i class="fa fa-pencil"></i> </a>
                    <a href="#" title="Delete" onclick="deleteData('events','eid',${full[0]})" data-toggle="tooltip" class="text-danger" >
                     <i class="fa fa-trash"></i> </a>
                    <a class='btn btn-sm btn-dark' href='event_det.php?id=${full['eid']}'>Read More</a>`;
                }
            }
        ]
    });
} else {
    var table = $("#resShowUp").DataTable({
        "scrollX": true,
        "bProcessing": true,
        "sAjaxSource": "ajax_table.php",
        "aoColumns": [{
                mData: 'e_name'
            },
            {
                mData: 'e_organizor'
            },
            {
                mData: 'e_date'
            },
            {
                mData: 'phone_no'
            },
            {
                "mRender": function(data, type, full) {
                    // console.log(full);
                    return `<a class='btn btn-sm btn-dark' href='event_det.php?id=${full['eid']}'>Read More</a>`;
                }
            }
        ]
    });
}
$("#resShowPre").DataTable();
</script>

<script>
$(document).ready(function() {
    $('#submit').click(function() {
        var ename = $('#ename').val();
        var oname = $('#oname').val();

        var formm = $('#submit_form')[0];
        if (ename == '' || oname == '') {
            $('#response').html('<span class="text-danger">All Fields are required</span>');
        } else {
            $.ajax({
                url: "ajax.php",
                method: "POST",
                processData: false,
                contentType: false,
                data: new FormData(formm),
                beforeSend: function() {
                    $('#response').html(
                        '<span class="text-info">Loading response...</span>');
                },
                success: function(data) {
                    $('form').trigger("reset");
                    $('#response').fadeIn().html(data);
                    setTimeout(function() {
                        $('#response').fadeOut("slow");
                        document.querySelector("#close-maodal").click();
                        var table = $("#resShowUp").DataTable();
                        table.ajax.reload();
                    }, 2000);
                }
            });
        }
    });
    $("#edate").datepicker({
        dateFormat: 'yy-mm-dd',
        startDate: '-3d'
    });
});
// for edit event
var table = $("#resShowUp").DataTable();
$('#resShowUp tbody').on('click', 'a[href="#add"]', function() {
    var data = table.row($(this).parents('tr')).data();
    // console.log(data);
    $('#eventModal').modal('show');
    // set value in modal to update
    $("#eid").val(data['eid']);
    $("#ename").val(data['e_name']);
    $("#oname").val(data['e_organizor']);
    $("#mobile").val(data['phone_no']);
    $("#sname").val(data['sponsor']);
    $("#edate").val(data['e_date']);
    $("#addr").val(data['e_addr']);
    $("#edesc").val(data['e_desc']);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        document.querySelector('#dpin').setAttribute('value', input.files[0].name);
        reader.onload = function(e) {
            $('#uploadPreview')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
//for delete event
function deleteData(table, table_id, id) {
    $.confirm({
        title: 'Are you sure!',
        content: 'You want to delete !!!',
        type: 'red',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Yes',
                btnClass: 'btn-red',
                action: function() {
                    $.ajax({
                        url: "ajax.php",
                        method: "POST",
                        data: {
                            table: table,
                            table_id: table_id,
                            id: id
                        },
                        success: function(data) {
                            setTimeout(function() {
                                var table = $("#resShowUp").DataTable();
                                table.ajax.reload();
                            }, 1000);
                        }
                    });
                }
            },
            close: {
                text: 'No',
            }
        }
    });
}
</script>

<!-- Modal -->
<div class="modal fade" id="eventModal" role="dialog" aria-labelledby="eventModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="post" id="submit_form">
                <input type="hidden" name="eid" id="eid">
                <div class="modal-header bg-primary" style="align-items: center;">
                    <h5 class="modal-title text-white" id="eventModalLabel2">Add Event</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                        style="display:flex;align-items: center; ">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color: #eee; overflow-y: scroll;">
                    <div class="row">
                        <div class=" col-md-6">
                            <div class="form-group">
                                <input required class="form-control" type="text" value="<?= $_POST["name"] ?>"
                                    name="name" placeholder="Event Name" id="ename" />
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <input required class="form-control" type="text" value="<?= $_POST["oname"] ?>"
                                    name="oname" placeholder="Organizer Name" id="oname" />
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <input required class="form-control" pattern="0?[7-9]{1}\d{9}" type="tel"
                                    value="<?= $_POST["phone_no"] ?>" name="phone_no" maxlength="10" id="mobile"
                                    placeholder="Contact No" />
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <input class="form-control" type="text" value="<?= $_POST["sname"] ?>" name="sname"
                                    id="sname" placeholder="Sponser Name" />
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <input required min="<?php echo date("Y-m-d") ?>" class="form-control" type="date"
                                    value="<?= $_POST["edate"] ?>" name="edate" id="edate" placeholder="Event Date" />
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <input required class="form-control" type="text" value="<?= $_POST["addr"] ?>"
                                    name="addr" id="addr" placeholder="Event Venue" />
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <textarea rows="4" class="form-control" name="edesc" id="edesc"
                                    placeholder="Description"><?= $_POST["edesc"] ?></textarea>
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <h4 style="color: red;"><?php echo $err; ?></h4>
                                <!-- <input class="form-control" type="file" name="at1" placeholder="Image" /> -->
                                <div class="row">
                                    <div class="col-md-4" style="padding-right: 0 !important;">
                                        <img src="./images/ccem.jpg"
                                            style="height: auto;object-fit:cover;max-width: 100%;max-height: 100px;"
                                            onclick="document.querySelector('#dp').click()" alt="" id="uploadPreview">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="dpin" readonly
                                            onclick="document.querySelector('#dp').click()" placeholder="Upload Image"
                                            style="background: white;" />
                                        <input class="form-control" type="file" name="at1" id="dp"
                                            onchange="readURL(this);" placeholder="Image" style="display: none;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="response"></div>
                    </div>
                </div>
                <div class="modal-footer" style="align-items: center;">
                    <button type="button" id="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" id="close-maodal"
                        data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal End -->
<?php require_once './footer.php';