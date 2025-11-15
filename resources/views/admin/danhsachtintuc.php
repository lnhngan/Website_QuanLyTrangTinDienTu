<!-- views/admin/danhsachtintuc.php -->
<?php include("../inc/top.php"); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-info mb-0">Quản lý tin tức thể thao</h4>
    <a href="index.php?action=themtintuc" class="btn btn-success">
        <i class="fas fa-plus"></i> Thêm tin mới
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Ngày đăng</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dstintuc = $nd->laydanhsachtintuc();
                    $i = 1;
                    foreach ($dstintuc as $tt):
                    ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td>
                            <?php if($tt["hinhanh"]): ?>
                                <img src="../../images/tintuc/<?= $tt["hinhanh"] ?>" alt="" width="60" class="rounded">
                            <?php else: ?>
                                <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?= htmlspecialchars($tt["tieude"]) ?></strong>
                            <small class="d-block text-muted"><?= substr(strip_tags($tt["noidung"]), 0, 80) ?>...</small>
                        </td>
                        <td><?= date("d/m/Y", strtotime($tt["ngaydang"])) ?></td>
                        <td class="text-center">
                            <a href="index.php?action=suatintuc&id=<?= $tt["id"] ?>" class="btn btn-sm btn-warning text-white" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?action=xoatintuc&id=<?= $tt["id"] ?>" 
                               class="btn btn-sm btn-danger" title="Xóa"
                               onclick="return confirm('Xóa tin này?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../inc/bottom.php"); ?>