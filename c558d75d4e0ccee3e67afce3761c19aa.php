<?php $__env->startSection('title','Pengaduan'); ?>
<?php $__env->startSection('page_title','Daftar Pengaduan'); ?>
<?php $__env->startSection('page_subtitle','Tangani pengaduan dari pelanggan'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-800/60">
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">No. / Judul</th>
                    <th class="text-left px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Prioritas</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-right px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                <?php $__empty_1 = true; $__currentLoopData = $pengaduan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors <?php echo e($p->status === 'baru' ? 'bg-blue-50/30' : ''); ?>">
                    <td class="px-5 py-3.5">
                        <p class="font-mono text-xs text-brand-600 dark:text-brand-400 mb-0.5"><?php echo e($p->nomor_pengaduan); ?></p>
                        <p class="font-semibold text-gray-800 dark:text-gray-200 text-sm"><?php echo e(Str::limit($p->judul, 40)); ?></p>
                        <p class="text-xs text-gray-400"><?php echo e($p->created_at->diffForHumans()); ?></p>
                    </td>
                    <td class="px-3 py-3.5">
                        <p class="font-medium text-gray-700 dark:text-gray-300 text-sm"><?php echo e($p->pelanggan->nama_pelanggan); ?></p>
                        <p class="text-xs text-gray-400"><?php echo e($p->pelanggan->nomor_pelanggan); ?></p>
                    </td>
                    <td class="px-3 py-3.5 text-center">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 capitalize"><?php echo e($p->jenis); ?></span>
                    </td>
                    <td class="px-3 py-3.5 text-center text-lg">
                        <?php echo e($p->prioritas === 'tinggi' ? '🔴' : ($p->prioritas === 'sedang' ? '🟡' : '🟢')); ?>

                    </td>
                    <td class="px-3 py-3.5 text-center">
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold <?php echo e($p->statusBadge()); ?>">
                            <?php echo e(ucfirst($p->status)); ?>

                        </span>
                    </td>
                    <td class="px-5 py-3.5 text-right">
                        <a href="<?php echo e(route('petugas.pengaduan.show', $p)); ?>"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-brand-600 bg-brand-50 dark:bg-brand-900/30 hover:bg-brand-100 dark:hover:bg-brand-900/50 rounded-lg transition-all">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="px-5 py-16 text-center text-gray-400">Tidak ada pengaduan</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($pengaduan->hasPages()): ?>
    <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-800">
        <?php echo e($pengaduan->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PamsimasBumnag\resources\views/petugas/pengaduan/index.blade.php ENDPATH**/ ?>