<?php $__env->startSection('title', 'Riwayat Input Meteran'); ?>
<?php $__env->startSection('page_title', 'Riwayat Input Meteran'); ?>
<?php $__env->startSection('page_subtitle', 'Histori semua input meteran yang Anda lakukan'); ?>

<?php $__env->startSection('content'); ?>

<div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
    
    <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Bulan</label>
                <select name="bulan" class="py-2.5 px-3 text-sm bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all">
                    <option value="">Semua Bulan</option>
                    <?php $__currentLoopData = range(1,12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($b); ?>" <?php echo e(request('bulan') == $b ? 'selected' : ''); ?>>
                        <?php echo e(\App\Services\TagihanService::namaBulan($b)); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">Tahun</label>
                <select name="tahun" class="py-2.5 px-3 text-sm bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all">
                    <option value="">Semua Tahun</option>
                    <?php $__currentLoopData = range(now()->year, now()->year - 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($y); ?>" <?php echo e(request('tahun') == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <button type="submit" class="px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl shadow transition-all">Filter</button>
            <?php if(request()->hasAny(['bulan','tahun'])): ?>
            <a href="<?php echo e(route('petugas.riwayat.index')); ?>" class="px-4 py-2.5 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 text-sm rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">Reset</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-800/60">
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Periode</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Awal</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Akhir</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pemakaian</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tagihan</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-right px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tgl Input</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                <?php $__empty_1 = true; $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors">
                    <td class="px-5 py-3.5">
                        <p class="font-semibold text-gray-800 dark:text-gray-200"><?php echo e($r->pelanggan->nama_pelanggan); ?></p>
                        <p class="text-xs text-gray-400"><?php echo e($r->pelanggan->nomor_pelanggan); ?></p>
                    </td>
                    <td class="px-3 py-3.5 text-center text-xs text-gray-600 dark:text-gray-400">
                        <?php echo e(\App\Services\TagihanService::namaBulan($r->bulan)); ?> <?php echo e($r->tahun); ?>

                    </td>
                    <td class="px-3 py-3.5 text-center text-gray-600 dark:text-gray-400"><?php echo e(number_format($r->angka_awal)); ?></td>
                    <td class="px-3 py-3.5 text-center text-gray-600 dark:text-gray-400"><?php echo e(number_format($r->angka_akhir)); ?></td>
                    <td class="px-3 py-3.5 text-center">
                        <span class="font-bold text-brand-600 dark:text-brand-400"><?php echo e(number_format($r->pemakaian, 1)); ?> m³</span>
                    </td>
                    <td class="px-3 py-3.5 text-center font-semibold text-gray-800 dark:text-white text-xs">
                        <?php if($r->tagihan): ?>
                        <?php echo e(\App\Services\TagihanService::formatRupiah($r->tagihan->total_tagihan)); ?>

                        <?php else: ?>
                        <span class="text-gray-400">—</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-3 py-3.5 text-center">
                        <?php if($r->tagihan): ?>
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold <?php echo e($r->tagihan->statusBadge()); ?>">
                            <?php echo e($r->tagihan->statusLabel()); ?>

                        </span>
                        <?php else: ?>
                        <span class="text-xs text-gray-400">Belum ada tagihan</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-5 py-3.5 text-right text-xs text-gray-400">
                        <?php echo e($r->created_at->format('d/m/Y H:i')); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="px-5 py-16 text-center">
                        <svg class="w-12 h-12 text-gray-200 dark:text-gray-700 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-gray-400">Belum ada riwayat input meteran</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($riwayat->hasPages()): ?>
    <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
        <p class="text-xs text-gray-400"><?php echo e($riwayat->firstItem()); ?>–<?php echo e($riwayat->lastItem()); ?> dari <?php echo e($riwayat->total()); ?></p>
        <div class="flex gap-1">
            <?php if(!$riwayat->onFirstPage()): ?>
            <a href="<?php echo e($riwayat->previousPageUrl()); ?>" class="px-3 py-1.5 text-xs rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">‹ Prev</a>
            <?php endif; ?>
            <?php if($riwayat->hasMorePages()): ?>
            <a href="<?php echo e($riwayat->nextPageUrl()); ?>" class="px-3 py-1.5 text-xs rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">Next ›</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PamsimasBumnag\resources\views/petugas/riwayat/index.blade.php ENDPATH**/ ?>