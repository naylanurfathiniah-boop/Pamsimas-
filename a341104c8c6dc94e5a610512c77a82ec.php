<?php $__env->startSection('title', 'Manajemen Tagihan'); ?>
<?php $__env->startSection('page_title', 'Manajemen Tagihan'); ?>
<?php $__env->startSection('page_subtitle', 'Kelola semua tagihan air pelanggan'); ?>

<?php $__env->startSection('content'); ?>


<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white dark:bg-gray-900 rounded-2xl p-4 border border-gray-100 dark:border-gray-800 shadow-sm">
        <p class="text-xs text-gray-400 mb-1">Total Tagihan</p>
        <p class="text-xl font-extrabold text-gray-900 dark:text-white"><?php echo e(number_format($totalTagihan)); ?></p>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-2xl p-4 border border-gray-100 dark:border-gray-800 shadow-sm">
        <p class="text-xs text-gray-400 mb-1">Sudah Lunas</p>
        <p class="text-xl font-extrabold text-emerald-600 dark:text-emerald-400"><?php echo e(number_format($totalLunas)); ?></p>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-2xl p-4 border border-gray-100 dark:border-gray-800 shadow-sm">
        <p class="text-xs text-gray-400 mb-1">Belum Bayar</p>
        <p class="text-xl font-extrabold text-amber-600 dark:text-amber-400"><?php echo e(number_format($totalBelumBayar)); ?></p>
    </div>
    
</div>


<div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
    
    <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800">
        <form method="GET" action="<?php echo e(route('admin.tagihan.index')); ?>" class="flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Cari</label>
                <div class="relative">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                        placeholder="Nama / nomor pelanggan / no tagihan..."
                        class="w-full pl-9 pr-4 py-2.5 text-sm bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-800 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
                <select name="status" class="py-2.5 px-3 text-sm bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all">
                    <option value="">Semua Status</option>
                    <option value="belum_bayar" <?php echo e(request('status') === 'belum_bayar' ? 'selected' : ''); ?>>Belum Bayar</option>
                    <option value="lunas"       <?php echo e(request('status') === 'lunas'       ? 'selected' : ''); ?>>Lunas</option>
                    <option value="terlambat"   <?php echo e(request('status') === 'terlambat'   ? 'selected' : ''); ?>>Terlambat</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Bulan</label>
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
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tahun</label>
                <select name="tahun" class="py-2.5 px-3 text-sm bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all">
                    <option value="">Semua Tahun</option>
                    <?php $__currentLoopData = range(now()->year, now()->year - 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($y); ?>" <?php echo e(request('tahun') == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <button type="submit" class="px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl shadow transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                </svg>
                Filter
            </button>
            <?php if(request()->hasAny(['search','status','bulan','tahun'])): ?>
            <a href="<?php echo e(route('admin.tagihan.index')); ?>" class="px-4 py-2.5 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 text-sm rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                Reset
            </a>
            <?php endif; ?>
        </form>
    </div>

    
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-800/60 border-b border-gray-100 dark:border-gray-800">
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">No. Tagihan</th>
                    <th class="text-left px-3 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pelanggan</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Periode</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pemakaian</th>
                    <th class="text-right px-3 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jatuh Tempo</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="text-center px-5 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                <?php $__empty_1 = true; $__currentLoopData = $tagihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors">
                    <td class="px-5 py-3.5">
                        <span class="font-mono text-xs font-semibold text-brand-600 dark:text-brand-400"><?php echo e($t->nomor_tagihan); ?></span>
                    </td>
                    <td class="px-3 py-3.5">
                        <div>
                            <p class="font-medium text-gray-800 dark:text-gray-200"><?php echo e($t->pelanggan->nama_pelanggan); ?></p>
                            <p class="text-xs text-gray-400"><?php echo e($t->pelanggan->nomor_pelanggan); ?></p>
                        </div>
                    </td>
                    <td class="px-3 py-3.5 text-center text-gray-600 dark:text-gray-400 text-xs">
                        <?php echo e(\App\Services\TagihanService::namaBulan($t->bulan)); ?> <?php echo e($t->tahun); ?>

                    </td>
                    <td class="px-3 py-3.5 text-center">
                        <span class="font-semibold text-gray-800 dark:text-gray-200"><?php echo e(number_format($t->pemakaian, 1)); ?> m³</span>
                    </td>
                    <td class="px-3 py-3.5 text-right font-bold text-gray-800 dark:text-white">
                        <?php echo e(\App\Services\TagihanService::formatRupiah($t->total_tagihan)); ?>

                    </td>
                    <td class="px-3 py-3.5 text-center text-xs text-gray-500 dark:text-gray-400">
                        <?php echo e($t->tanggal_jatuh_tempo->format('d/m/Y')); ?>

                        <?php if($t->tanggal_jatuh_tempo->isPast() && $t->status !== 'lunas'): ?>
                        <span class="block text-red-500 text-xs">Lewat</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-3 py-3.5 text-center">
                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold <?php echo e($t->statusBadge()); ?>">
                            <?php echo e($t->statusLabel()); ?>

                        </span>
                    </td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center justify-center gap-1.5">
                            <a href="<?php echo e(route('admin.tagihan.show', $t)); ?>"
                                class="p-1.5 rounded-lg text-brand-600 hover:bg-brand-50 dark:hover:bg-brand-900/30 transition-all" title="Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                           
                                <a href="<?php echo e(in_array($t->status, ['belum_bayar', 'terlambat'])
                                    ? route('admin.pembayaran.index') . '?pelanggan_id=' . $t->pelanggan_id . '&tagihan_id=' . $t->id
                                    : route('admin.tagihan.edit', $t)); ?>"
                                    class="p-1.5 rounded-lg text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/30 transition-all"
                                    title="<?php echo e(in_array($t->status, ['belum_bayar', 'terlambat']) ? 'Proses Pembayaran' : 'Edit Status'); ?>">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <?php if($t->status !== 'lunas'): ?>
                            <form method="POST" action="<?php echo e(route('admin.tagihan.destroy', $t)); ?>"
                                onsubmit="return confirm('Yakin hapus tagihan <?php echo e($t->nomor_tagihan); ?>?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="p-1.5 rounded-lg text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 transition-all" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="px-5 py-16 text-center">
                        <svg class="w-14 h-14 text-gray-200 dark:text-gray-700 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-gray-400 font-medium">Tidak ada tagihan ditemukan</p>
                        <p class="text-gray-300 dark:text-gray-600 text-sm mt-1">Coba ubah filter pencarian</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <?php if($tagihan->hasPages()): ?>
    <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
        <p class="text-xs text-gray-400">
            Menampilkan <?php echo e($tagihan->firstItem()); ?>–<?php echo e($tagihan->lastItem()); ?> dari <?php echo e($tagihan->total()); ?> tagihan
        </p>
        <div class="flex gap-1">
            <?php if($tagihan->onFirstPage()): ?>
                <span class="px-3 py-1.5 text-xs rounded-lg text-gray-300 dark:text-gray-600 cursor-not-allowed">‹ Prev</span>
            <?php else: ?>
                <a href="<?php echo e($tagihan->previousPageUrl()); ?>" class="px-3 py-1.5 text-xs rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">‹ Prev</a>
            <?php endif; ?>
            <?php $__currentLoopData = $tagihan->getUrlRange(max(1, $tagihan->currentPage()-2), min($tagihan->lastPage(), $tagihan->currentPage()+2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($page == $tagihan->currentPage()): ?>
                    <span class="px-3 py-1.5 text-xs rounded-lg bg-brand-600 text-white font-semibold"><?php echo e($page); ?></span>
                <?php else: ?>
                    <a href="<?php echo e($url); ?>" class="px-3 py-1.5 text-xs rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all"><?php echo e($page); ?></a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($tagihan->hasMorePages()): ?>
                <a href="<?php echo e($tagihan->nextPageUrl()); ?>" class="px-3 py-1.5 text-xs rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">Next ›</a>
            <?php else: ?>
                <span class="px-3 py-1.5 text-xs rounded-lg text-gray-300 dark:text-gray-600 cursor-not-allowed">Next ›</span>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PamsimasBumnag\resources\views/admin/tagihan/index.blade.php ENDPATH**/ ?>