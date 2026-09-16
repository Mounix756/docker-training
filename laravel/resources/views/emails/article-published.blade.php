<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Article</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f5f7;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }
        .header {
            background-color: #1f2937;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .hero-image {
            width: 100%;
            max-height: 280px;
            object-fit: cover;
            display: block;
        }
        .content {
            padding: 32px 24px;
        }
        .badge {
            display: inline-block;
            background-color: #e0e7ff;
            color: #4338ca;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }
        .article-title {
            color: #111827;
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 16px 0;
            line-height: 1.3;
        }
        .article-excerpt {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .btn-wrapper {
            text-align: center;
            margin: 28px 0 12px 0;
        }
        .btn {
            background-color: #2563eb;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 15px;
            display: inline-block;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            color: #9ca3af;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- En-tête -->
        <div class="header">
            <h1>Mon Blog</h1>
        </div>

        <!-- Première image de la galerie si présente -->
        @if($article->images && $article->images->count() > 0)
            <img class="hero-image" src="{{ asset('storage/' . $article->images->first()->image_path) }}" alt="{{ $article->title }}">
        @endif

        <!-- Aperçu de l'article -->
        <div class="content">
            <span class="badge">Nouveau Billet</span>
            <h2 class="article-title">{{ $article->title }}</h2>

            <p class="article-excerpt">
                {{ Str::limit(strip_tags($article->content), 180) }}
            </p>

            <div class="btn-wrapper">
                <a href="{{ url('/articles/' . $article->id) }}" class="btn">Lire l'article complet</a>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <p style="margin: 0 0 6px 0;">Vous recevez cet e-mail car vous êtes abonné à la newsletter du blog.</p>
            <p style="margin: 0;">&copy; {{ date('Y') }} Mon Blog. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
