<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Komentar - Lab MMT Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#64748b',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <?php require_once '../app/views/layouts/admin_header.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-comments mr-2 text-primary"></i>Kelola Komentar
            </h1>
        </div>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <i class="fas fa-check-circle mr-2"></i>
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Filter Tabs -->
        <div class="bg-white rounded-lg shadow-md mb-6">
            <div class="flex border-b">
                <a href="<?= BASE_URL ?>/admin/comments" 
                   class="px-6 py-3 <?= !isset($_GET['filter']) || $_GET['filter'] == 'all' ? 'border-b-2 border-primary text-primary font-semibold' : 'text-gray-600 hover:text-primary' ?>">
                    <i class="fas fa-list mr-2"></i>Semua Komentar (<?= count($comments) ?>)
                </a>
                <a href="<?= BASE_URL ?>/admin/comments?filter=pending" 
                   class="px-6 py-3 <?= isset($_GET['filter']) && $_GET['filter'] == 'pending' ? 'border-b-2 border-primary text-primary font-semibold' : 'text-gray-600 hover:text-primary' ?>">
                    <i class="fas fa-clock mr-2"></i>Tertunda 
                    <?php 
                    $pending_count = 0;
                    foreach($comments as $comment) {
                        if (!$comment['is_approved']) $pending_count++;
                    }
                    if ($pending_count > 0): ?>
                        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full"><?= $pending_count ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>

        <!-- Comments Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proyek</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontributor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komentar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($comments)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2"></i>
                                <p>Tidak ada komentar ditemukan.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php 
                        $filter = $_GET['filter'] ?? 'all';
                        foreach($comments as $comment): 
                            // Apply filter
                            if ($filter == 'pending' && $comment['is_approved']) continue;
                        ?>
                            <tr class="hover:bg-gray-50 <?= !$comment['is_approved'] ? 'bg-yellow-50' : '' ?>">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($comment['is_approved']): ?>
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>Disetujui
                                        </span>
                                    <?php else: ?>
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>Tertunda
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($comment['project_title']) ?>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        ID: <?= $comment['project_id'] ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($comment['contributor_name'] ?? 'Anonymous') ?>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <?= $comment['contributor_email'] ? htmlspecialchars($comment['contributor_email']) : '-' ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-md truncate" title="<?= htmlspecialchars($comment['comment']) ?>">
                                        <?= htmlspecialchars(substr($comment['comment'], 0, 100)) . (strlen($comment['comment']) > 100 ? '...' : '') ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= date('d M Y', strtotime($comment['created_at'])) ?>
                                    <br>
                                    <span class="text-xs"><?= date('H:i', strtotime($comment['created_at'])) ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex space-x-2">
                                        <?php if ($comment['is_approved']): ?>
                                            <form action="<?= BASE_URL ?>/admin/comments_unapprove/<?= $comment['id'] ?>" method="POST" class="inline">
                                                <button type="submit" 
                                                        onclick="return confirm('Unapprove this comment?')"
                                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition"
                                                        title="Unapprove">
                                                    <i class="fas fa-times-circle"></i>
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <form action="<?= BASE_URL ?>/admin/comments_approve/<?= $comment['id'] ?>" method="POST" class="inline">
                                                <button type="submit" 
                                                        onclick="return confirm('Approve this comment?')"
                                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition"
                                                        title="Approve">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        
                                        <form action="<?= BASE_URL ?>/admin/comments_delete/<?= $comment['id'] ?>" method="POST" class="inline">
                                            <button type="submit" 
                                                    onclick="return confirm('Delete this comment permanently?')"
                                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</body>
</html>
