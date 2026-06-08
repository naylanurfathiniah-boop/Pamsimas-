<?php $__env->startSection('title', 'Input Meteran'); ?>
<?php $__env->startSection('page_title', 'Input Meteran'); ?>
<?php $__env->startSection('page_subtitle', 'Status input meteran bulan ' . \App\Services\TagihanService::namaBulan($bulan) . ' ' . $tahun); ?>

<?php $__env->startSection('content'); ?>


<div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-4 mb-4 flex flex-wrap items-center gap-3">
    <form method="GET" action="<?php echo e(route('petugas.meteran.index')); ?>" class="flex flex-wrap items-center gap-3 flex-1">
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Bulan</label>
            <select name="bulan" class="py-2 px-3 text-sm bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all">
                <?php $__currentLoopData = range(1,12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($b); ?>" <?php echo e($bulan == $b ? 'selected' : ''); ?>><?php echo e(\App\Services\TagihanService::namaBulan($b)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Tahun</label>
            <select name="tahun" class="py-2 px-3 text-sm bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all">
                <?php $__currentLoopData = range(now()->year, now()->year - 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($y); ?>" <?php echo e($tahun == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="py-2 px-4 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl shadow transition-all">
                Tampilkan
            </button>
        </div>
    </form>
    <a href="<?php echo e(route('petugas.meteran.create')); ?>"
        class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-bold rounded-xl shadow-md transition-all">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Input Meteran
    </a>
</div>


<?php
    $totalPlg  = $pelangganList->count();
    $sudah     = count($sudahInput);
    $belum     = $totalPlg - $sudah;
    $pct       = $totalPlg > 0 ? round($sudah / $totalPlg * 100) : 0;
?>
<div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-5 mb-4">
    <div class="flex items-center justify-between mb-2">
        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Progress Input Bulan Ini</p>
        <p class="text-sm font-bold text-brand-600 dark:text-brand-400"><?php echo e($sudah); ?> / <?php echo e($totalPlg); ?> (<?php echo e($pct); ?>%)</p>
    </div>
    <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-3">
        <div class="h-3 rounded-full bg-gradient-to-r from-brand-500 to-brand-400 transition-all duration-500"
            style="width: <?php echo e($pct); ?>%"></div>
    </div>
    <div class="flex gap-4 mt-2 text-xs text-gray-400">
        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-emerald-400 inline-block"></span>Sudah: <?php echo e($sudah); ?></span>
        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block"></span>Belum: <?php echo e($belum); ?></span>
    </div>
</div>


<?php if($jorongList->isNotEmpty()): ?>
<div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-4 mb-4">
    <p class="text-xs font-semibold text-gray-500 mb-2">Jorong yang ditugaskan:</p>
    <div class="flex flex-wrap gap-2">
        <?php $__currentLoopData = $jorongList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span class="px-3 py-1 bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 rounded-full text-xs font-semibold">
            <?php echo e($j->nama_jorong); ?>

        </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php else: ?>
<div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-2xl p-4 mb-4">
    <p class="text-sm text-amber-700 dark:text-amber-300 font-medium">Anda belum ditugaskan ke jorong manapun. Hubungi admin.</p>
</div>
<?php endif; ?>


<div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800">
        <h3 class="font-bold text-gray-800 dark:text-white text-sm">
            Daftar Pelanggan — <?php echo e(\App\Services\TagihanService::namaBulan($bulan)); ?> <?php echo e($tahun); ?>

        </h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-800/60">
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                    <th class="text-left px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Jorong</th>
                    <th class="text-left px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Meteran Ref</th>
                    <th class="text-center px-3 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-center px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                <?php $__empty_1 = true; $__currentLoopData = $pelangganList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php $sudahDiinput = in_array($plg->id, $sudahInput); ?>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors">
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                <?php echo e(strtoupper(substr($plg->nama_pelanggan, 0, 2))); ?>

                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-200"><?php echo e($plg->nama_pelanggan); ?></p>
                                <p class="text-xs text-gray-400"><?php echo e($plg->nomor_pelanggan); ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-3 py-3.5">
                        <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-lg text-xs font-medium">
                            <?php echo e($plg->jorong->nama_jorong ?? '-'); ?>

                        </span>
                    </td>
                    <td class="px-3 py-3.5 text-gray-600 dark:text-gray-400 text-xs"><?php echo e($plg->alamat); ?></td>
                    <td class="px-3 py-3.5 text-center">
                        <?php if($sudahDiinput && $plg->meteranAir->isNotEmpty()): ?>
                            <span class="font-semibold text-gray-800 dark:text-gray-200"><?php echo e(number_format($plg->meteranAir->first()->angka_akhir)); ?></span>
                            <span class="text-xs text-gray-400 block">Angka akhir</span>
                        <?php else: ?>
                            <span class="text-gray-400 text-xs"><?php echo e(number_format($plg->meteran_awal)); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="px-3 py-3.5 text-center">
                        <?php if($sudahDiinput): ?>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Sudah Input
                        </span>
                        <?php else: ?>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01"/></svg>
                            Belum Input
                        </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-5 py-3.5 text-center">
                        <?php if($sudahDiinput): ?>
                            <?php $m = $plg->meteranAir->first(); ?>
                            <?php if($m): ?>
                            <a href="<?php echo e(route('petugas.meteran.show', $m)); ?>"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-brand-600 bg-brand-50 dark:bg-brand-900/30 hover:bg-brand-100 rounded-lg transition-all">
                                Detail
                            </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('petugas.meteran.create', ['pelanggan_id' => $plg->id, 'bulan' => $bulan, 'tahun' => $tahun])); ?>"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-brand-600 hover:bg-brand-700 rounded-lg shadow transition-all">
                                Input
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                        <?php if($jorongList->isEmpty()): ?>
                            Belum ditugaskan ke jorong manapun
                        <?php else: ?>
                            Tidak ada pelanggan di jorong yang ditugaskan
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PamsimasBumnag\resources\views/petugas/meteran/index.blade.php ENDPATH**/ ?>