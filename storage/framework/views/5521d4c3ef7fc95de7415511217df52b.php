

<?php $__env->startSection('content'); ?>
    <?php
        function formatAngka($value)
        {
            if (floor($value) == $value) {
                return number_format($value, 0, '.', '');
            }
            return rtrim(rtrim(number_format($value, 10, '.', ''), '0'), '.');
        }

        function formatPersen($value)
        {
            $value = floor($value * 10) / 10;
            if (floor($value) == $value) {
                return number_format($value, 0, '.', '');
            }
            return number_format($value, 1, '.', '');
        }
    ?>

    <div class="container-fluid px-4 py-4">

        <!-- HEADER dengan Search -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h4 class="mb-0">Data BLC Upload FRN</h4>

            <div class="d-flex gap-2 flex-wrap">
                <!-- Form Pencarian -->
                <form action="<?php echo e(route('blc-upload-frns.index')); ?>" method="GET" class="d-flex">
                    <div class="input-group" style="width: 350px;">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari KP, Style, Item, Color, Relax, Country..." value="<?php echo e(request('search')); ?>"
                            autocomplete="off">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bx bx-search"></i>
                        </button>

                        <?php if(request('search')): ?>
                            <a href="<?php echo e(route('blc-upload-frns.index')); ?>" class="btn btn-outline-secondary">
                                <i class="bx bx-x"></i> Clear
                            </a>
                        <?php endif; ?>
                    </div>
                </form>

                <a href="<?php echo e(route('blc-upload-frns.create')); ?>" class="btn btn-primary">
                    <i class="bx bx-plus"></i> Tambah Data
                </a>
            </div>
        </div>

        <!-- ================= MOBILE VIEW ================= -->
        <div class="d-md-none">
            <div class="row g-3">
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $progress = $row->progress;
                        $blc = $row->blc;
                        $absBlc = abs($blc);

                        if ($blc < 0) {
                            $statusClass = 'text-danger fw-bold';
                            $statusText = formatAngka($absBlc) . ' pcs kurang';
                        } elseif ($blc > 0) {
                            $statusClass = 'text-primary fw-bold';
                            $statusText = formatAngka($absBlc) . ' pcs lebih';
                        } else {
                            $statusClass = 'text-success fw-bold';
                            $statusText = '0 pcs tepat';
                        }
                    ?>

                    <div class="col-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="fw-bold mb-1 text-primary">
                                    Style : <?php echo e($row->style); ?>

                                </h6>

                                <div class="small text-muted mb-2">
                                    User : <?php echo e($row->user?->username ?? '-'); ?>

                                </div>

                                <div class="small">
                                    Relax: <strong><?php echo e($row->relax); ?></strong> •
                                    PODO: <strong><?php echo e($row->podo ? $row->podo->format('d M Y') : '-'); ?></strong>
                                </div>

                                <div class="small text-muted mb-3 border-bottom pb-2">
                                    <div class="d-flex gap-3">
                                        <div><?php echo e($row->kp); ?> • <?php echo e($row->country); ?></div>
                                    </div>
                                    <div class="small">
                                        <?php echo e($row->item); ?> • <?php echo e($row->color); ?>

                                    </div>
                                </div>

                                <!-- PROGRESS -->
                                <div class="mb-4">
                                    <div class="small fw-bold mb-1">Progress</div>
                                    <div class="progress mb-1" style="height:10px;">
                                        <div class="progress-bar <?php echo e($progress > 100 ? 'bg-primary' : 'bg-success'); ?>"
                                            style="width: <?php echo e(min($progress, 100)); ?>%">
                                        </div>
                                    </div>
                                    <small
                                        class="<?php echo e($progress >= 100 ? 'text-success fw-bold' : 'text-warning fw-bold'); ?>">
                                        <?php echo e(formatPersen($progress)); ?>%
                                    </small>
                                    <?php if($progress > 100): ?>
                                        <br>
                                        <small class="text-primary fw-bold">
                                            Over Production <?php echo e(formatPersen($progress - 100)); ?>%
                                        </small>
                                    <?php endif; ?>
                                </div>

                                <!-- QTY -->
                                <div class="small mb-3">
                                    <div>
                                        <strong>Request :</strong> <?php echo e(number_format($row->qty_request)); ?> pcs
                                    </div>
                                    <div>
                                        <strong>Filled :</strong> <?php echo e(formatAngka($row->current_filled)); ?> pcs
                                    </div>

                                    <div class="mt-2">
                                        <strong>Edit BLC :</strong>
                                        <form action="<?php echo e(route('blc-upload-frns.update-blc', $row)); ?>" method="POST"
                                            class="d-flex gap-2 mt-1">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <input type="number" name="blc" step="any" value="<?php echo e($row->blc); ?>"
                                                class="form-control form-control-sm">
                                            <button class="btn btn-sm btn-success">
                                                <i class="bx bx-save"></i>
                                            </button>
                                        </form>
                                        <div class="small mt-1 <?php echo e($statusClass); ?>">
                                            <?php echo e($statusText); ?>

                                        </div>
                                    </div>
                                </div>

                                <!-- Aksi dengan Tombol Copy -->
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="<?php echo e(route('blc-upload-frns.show', $row)); ?>"
                                        class="btn btn-sm btn-outline-info">Detail</a>
                                    <a href="<?php echo e(route('blc-upload-frns.edit', $row)); ?>"
                                        class="btn btn-sm btn-outline-warning">Edit</a>

                                    <!-- Tombol Copy -->
                                    <form action="<?php echo e(route('blc-upload-frns.copy', $row)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-success"
                                            onclick="return confirm('Buat salinan data ini?\nKP akan ditambahkan (Copy)')">
                                            Copy
                                        </button>
                                    </form>

                                    <form action="<?php echo e(route('blc-upload-frns.destroy', $row)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center py-4">
                            <?php if(request('search')): ?>
                                Tidak ditemukan data untuk pencarian "<strong><?php echo e(request('search')); ?></strong>"
                            <?php else: ?>
                                Belum ada data BLC Upload FRN
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- ================= DESKTOP VIEW ================= -->
        <div class="d-none d-md-block">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk Info</th>
                                    <th>Relax</th>
                                    <th>PODO</th>
                                    <th>User</th>
                                    <th>Request</th>
                                    <th>Filled</th>
                                    <th>BLC</th>
                                    <th>Progress</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $progress = $row->progress;
                                        $blc = $row->blc;
                                        $absBlc = abs($blc);

                                        if ($blc < 0) {
                                            $statusClass = 'text-danger fw-bold';
                                            $statusText = formatAngka($absBlc) . ' pcs kurang';
                                        } elseif ($blc > 0) {
                                            $statusClass = 'text-primary fw-bold';
                                            $statusText = formatAngka($absBlc) . ' pcs lebih';
                                        } else {
                                            $statusClass = 'text-success fw-bold';
                                            $statusText = '0 pcs tepat';
                                        }
                                    ?>

                                    <tr>
                                        <td>
                                            <div class="fw-bold"><?php echo e($row->style); ?></div>
                                            <div class="small text-muted d-flex gap-3">
                                                <div><?php echo e($row->kp); ?></div> •
                                                <div><?php echo e($row->country); ?></div>
                                            </div>
                                            <div class="small">
                                                <?php echo e($row->item); ?> • <?php echo e($row->color); ?>

                                            </div>
                                        </td>
                                        <td><?php echo e($row->relax); ?></td>
                                        <td><?php echo e($row->podo ? $row->podo->format('d M Y') : '-'); ?></td>
                                        <td><?php echo e($row->user?->username ?? '-'); ?></td>
                                        <td class="text-center"><?php echo e(number_format($row->qty_request)); ?></td>
                                        <td class="text-center"><?php echo e(formatAngka($row->current_filled)); ?></td>
                                        <td>
                                            <form action="<?php echo e(route('blc-upload-frns.update-blc', $row)); ?>" method="POST"
                                                class="d-flex gap-1">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <input type="number" name="blc" step="any"
                                                    value="<?php echo e($row->blc); ?>" class="form-control form-control-sm"
                                                    style="width:90px">
                                                <button class="btn btn-sm btn-success">
                                                    <i class="bx bx-save"></i>
                                                </button>
                                            </form>
                                            <div class="small mt-1 <?php echo e($statusClass); ?>">
                                                <?php echo e($statusText); ?>

                                            </div>
                                        </td>
                                        <td width="220">
                                            <div class="progress mb-1" style="height:8px;">
                                                <div class="progress-bar <?php echo e($progress > 100 ? 'bg-primary' : 'bg-success'); ?>"
                                                    style="width: <?php echo e(min($progress, 100)); ?>%">
                                                </div>
                                            </div>
                                            <small class="<?php echo e($progress >= 100 ? 'text-success fw-bold' : ''); ?>">
                                                <?php echo e(formatPersen($progress)); ?>%
                                            </small>
                                            <?php if($progress > 100): ?>
                                                <br>
                                                <small class="text-primary fw-bold">
                                                    Over <?php echo e(formatPersen($progress - 100)); ?>%
                                                </small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 flex-wrap">
                                                <a href="<?php echo e(route('blc-upload-frns.show', $row)); ?>"
                                                    class="btn btn-sm btn-outline-info">Detail</a>
                                                <a href="<?php echo e(route('blc-upload-frns.edit', $row)); ?>"
                                                    class="btn btn-sm btn-outline-warning">Edit</a>

                                                <!-- Tombol Copy -->
                                                <form action="<?php echo e(route('blc-upload-frns.copy', $row)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-sm btn-outline-success"
                                                        onclick="return confirm('Buat salinan data ini?\nKP akan ditambahkan (Copy)')">
                                                        Copy
                                                    </button>
                                                </form>

                                                <form action="<?php echo e(route('blc-upload-frns.destroy', $row)); ?>"
                                                    method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Yakin hapus data ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-muted">
                                            <?php if(request('search')): ?>
                                                Tidak ditemukan data untuk pencarian
                                                "<strong><?php echo e(request('search')); ?></strong>"
                                            <?php else: ?>
                                                Belum ada data BLC Upload FRN
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laravel\magang-wh-fab\blc-upload\resources\views/blc-upload-frns/index.blade.php ENDPATH**/ ?>