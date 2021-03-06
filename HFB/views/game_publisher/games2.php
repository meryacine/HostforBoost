<?php include("top.php"); ?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Games</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Games Info</p>
        </div>
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover my-0" id="gamesTable" data-toggle="table" data-pagination="true" data-search="true" data-detail-view="true" data-detail-formatter="detailFormatter" data-page-size="5" data-page-list="[5,10,15,all]" data-pagenation-pre-text="Prev" data-pagenation-next-text="Next" data-pagenation-detail-h-alaign="right" data-locale="en-us">
                    <thead>
                        <tr>
                            <th>Poster</th>
                            <th data-sortable="true">Name</th>
                            <th>Genre</th>
                            <th data-sortable="true">Released date</th>
                            <th>Publisher</th>
                            <th data-sortable="true">Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * from `Game`";
                        $result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
                        while ($record = mysqli_fetch_assoc($result_set)) {
                        ?>
                            <tr data-GID=<?php echo $record['GID']; ?> data-curUser="<?php echo $username; ?>">
                                <td><img class="rounded mr-2" width="129" height="172" src="../../assets/img/games/<?php echo $record['GPoster']; ?>"></td>
                                <td class="text-left"><?php echo $record['GName']; ?></td>
                                <td class="text-left"><?php echo $record['GGenre']; ?></td>
                                <td class="text-left"><?php echo $record['GReleasedDate']; ?></td>
                                <td class="text-left"><?php echo $record['GPublisher']; ?></td>
                                <td class="text-left"><?php echo $record['GRate']; ?>/10</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Poster</strong></td>
                            <td><strong>Name</strong></td>
                            <td><strong>Genre</strong></td>
                            <td><strong>Released Date</strong></td>
                            <td><strong>Publisher</strong></td>
                            <td><strong>Rate</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal to be used later-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Info..</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


</div>
<?php include("lower.php"); ?>