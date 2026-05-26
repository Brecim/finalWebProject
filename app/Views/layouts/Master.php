<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieDB</title>
    <?=$this->include("layouts/links");?>
    <style>
        :root {
            --app-bg: #f3efe5;
            --app-surface: rgba(255, 255, 255, 0.82);
            --app-text: #1f2937;
            --app-accent: #d97706;
            --app-accent-2: #0f766e;
        }

        body {
            min-height: 100vh;
            color: var(--app-text);
            background:
                radial-gradient(circle at top left, rgba(217, 119, 6, 0.16), transparent 30%),
                radial-gradient(circle at top right, rgba(15, 118, 110, 0.12), transparent 28%),
                linear-gradient(180deg, #fcfaf6 0%, var(--app-bg) 100%);
        }

        .app-shell {
            position: relative;
            overflow-x: hidden;
        }

        .app-shell::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image: linear-gradient(rgba(255, 255, 255, 0.12) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.12) 1px, transparent 1px);
            background-size: 48px 48px;
            opacity: 0.25;
            mask-image: linear-gradient(180deg, rgba(0, 0, 0, 0.5), transparent 85%);
        }

        .brand-mark {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--app-accent), #f59e0b);
            color: #fff;
            font-weight: 800;
            letter-spacing: 0.08em;
            box-shadow: 0 12px 30px rgba(217, 119, 6, 0.25);
        }

        .app-navbar {
            backdrop-filter: blur(14px);
            background: rgba(255, 255, 255, 0.78);
            border-bottom: 1px solid rgba(31, 41, 55, 0.08);
        }

        .btn-app-accent {
            background: var(--app-accent-2);
            border-color: var(--app-accent-2);
            color: #fff;
            box-shadow: 0 10px 24px rgba(15, 118, 110, 0.18);
        }

        .btn-app-accent:hover,
        .btn-app-accent:focus {
            background: #0b6058;
            border-color: #0b6058;
            color: #fff;
        }

        .app-main {
            position: relative;
            z-index: 1;
        }

        .hero-panel,
        .film-panel,
        .poster-card,
        .movie-card {
            border: 0;
            border-radius: 1.75rem;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.12);
        }

        .hero-panel {
            overflow: hidden;
            background: linear-gradient(135deg, rgba(15, 118, 110, 0.95), rgba(15, 23, 42, 0.95));
            color: #fff;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.85rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            color: rgba(255, 255, 255, 0.92);
            font-size: 0.85rem;
        }

        .section-title {
            letter-spacing: -0.03em;
        }

        .movie-card {
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            background: var(--app-surface);
            backdrop-filter: blur(10px);
        }

        .movie-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.18);
        }

        .movie-poster {
            aspect-ratio: 2 / 3;
            object-fit: cover;
            width: 100%;
            display: block;
        }

        .movie-meta {
            color: rgba(31, 41, 55, 0.7);
            font-size: 0.95rem;
        }

        .film-panel {
            overflow: hidden;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
        }

        .poster-card {
            overflow: hidden;
            background: #111827;
        }

        .poster-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            min-height: 100%;
        }

        .info-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            background: rgba(15, 118, 110, 0.1);
            color: #0f766e;
            font-weight: 600;
        }

        .admin-table-frame {
            padding: 0;
            border-radius: 2rem;
            background: transparent;
            box-shadow: none;
        }

        .admin-table-shell {
            border-radius: 2rem;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.95);
        }

        .admin-table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .admin-table thead th,
        .admin-table td {
            border-color: rgba(15, 23, 42, 0.10);
        }

        .admin-table thead th {
            background: rgba(241, 245, 249, 0.98);
            border-bottom-width: 1px;
            color: #111827;
        }

        .admin-table thead th:first-child {
            border-top-left-radius: 1.9rem;
        }

        .admin-table thead th:last-child {
            border-top-right-radius: 1.9rem;
        }

        .admin-table tbody tr:last-child td:first-child {
            border-bottom-left-radius: 1.9rem;
        }

        .admin-table tbody tr:last-child td:last-child {
            border-bottom-right-radius: 1.9rem;
        }

        .admin-table tbody tr:last-child td {
            border-bottom: 0;
        }
    </style>
</head>
<body class="app-shell">
    <?=$this->include("layouts/navbar");?>
    
    <main class="app-main">
        <?= $this->renderSection("content"); ?>
    </main>
</body>
</html>