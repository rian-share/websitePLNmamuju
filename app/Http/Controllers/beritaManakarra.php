<?php

namespace App\Http\Controllers;

use App\Models\Whatsapp_cs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Embed\Embed; // Library untuk ambil meta data
use Carbon\Carbon;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class BeritaManakarra extends Controller
{
    public function getBerita()
    {
        $rssUrl = "https://news.google.com/rss/search?q=PLN+Mamuju&hl=id&gl=ID&ceid=ID:id";
        $cs = Whatsapp_cs::find(1);
        $rssContent = file_get_contents($rssUrl);
        if (!$rssContent) {
            return response()->json([
                'error' => 'Gagal mengambil RSS'
            ], 500);
        }
        $xml = simplexml_load_string($rssContent, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (!$xml || !isset($xml->channel->item)) {
            return response()->json([
                'error' => 'Format RSS tidak valid'
            ], 500);
        }
        $itemsArray = [];
        foreach ($xml->channel->item as $item) {
            $sourceUrl = '';
            $sourceName = '';
            if (isset($item->source)) {
                $source = $item->source;

                $attributes = $source->attributes();
                if ($attributes && isset($attributes['url'])) {
                    $sourceUrl = (string) $attributes['url'];
                }
                $sourceName = (string) $source;

                if (!$sourceUrl) {
                    $sourceUrl = "https://" . trim($sourceName);
                }
            }
            $publisherLogo = $sourceUrl
                ? "https://www.google.com/s2/favicons?sz=64&domain=" . parse_url($sourceUrl, PHP_URL_HOST)
                : null;

            $itemsArray[] = [
                'title' => (string) $item->title,
                'link'  => (string) $item->link,
                'guid'  => (string) $item->guid,
                'pubDate' => (string) $item->pubDate,
                'description' => (string) $item->description,
                'source_name' => $sourceName,
                'source_url' => $sourceUrl,
                'publisher_logo' => $publisherLogo,
            ];
        }

        $data1 = $itemsArray[0];
        $data2 = $itemsArray[1];
        $data3 = $itemsArray[2];
        return view('beranda', compact('data1', 'data2', 'data3','cs'));
    }

    public function allBerita()
    {
        $rssUrl = "https://news.google.com/rss/search?q=PLN+Mamuju&hl=id&gl=ID&ceid=ID:id";
        $rssContent = file_get_contents($rssUrl);
        $cs = Whatsapp_cs::find(1);
        if (!$rssContent) {
            return response()->json([
                'error' => 'Gagal mengambil RSS'
            ], 500);
        }
        $xml = simplexml_load_string($rssContent, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (!$xml || !isset($xml->channel->item)) {
            return response()->json([
                'error' => 'Format RSS tidak valid'
            ], 500);
        }
        $itemsArray = [];
        foreach ($xml->channel->item as $item) {
            $sourceUrl = '';
            $sourceName = '';
            if (isset($item->source)) {
                $source = $item->source;
                $attributes = $source->attributes();
                if ($attributes && isset($attributes['url'])) {
                    $sourceUrl = (string) $attributes['url'];
                }
                $sourceName = (string) $source;
                if (!$sourceUrl) {
                    $sourceUrl = "https://" . trim($sourceName);
                }
                $publisherLogo = $sourceUrl
                    ? "https://www.google.com/s2/favicons?sz=64&domain=" . parse_url($sourceUrl, PHP_URL_HOST)
                    : null;

                $itemsArray[] = [
                    'title' => (string) $item->title,
                    'link'  => (string) $item->link,
                    'guid'  => (string) $item->guid,
                    'pubDate' => (string) $item->pubDate,
                    'description' => (string) $item->description,
                    'source_name' => $sourceName,
                    'source_url' => $sourceUrl,
                    'publisher_logo' => $publisherLogo,
                ];
            }
        }
        return view('berita', compact('itemsArray','cs'));
    }

    public function searchBerita($search)
    {
        $rssUrl = "https://news.google.com/rss/search?q=PLN+Mamuju&hl=id&gl=ID&ceid=ID:id";

        $rssContent = @file_get_contents($rssUrl);

        if (!$rssContent) {
            return response()->json([
                'error' => 'Gagal mengambil RSS'
            ], 500);
        }

        $xml = simplexml_load_string($rssContent, 'SimpleXMLElement', LIBXML_NOCDATA);

        if (!$xml || !isset($xml->channel->item)) {
            return response()->json([
                'error' => 'Format RSS tidak valid'
            ], 500);
        }

        $itemsArray = [];

        foreach ($xml->channel->item as $item) {
            $sourceUrl = '';
            $sourceName = '';

            $title = (string) $item->title;

            // pencarian case-insensitive
            if (!Str::contains(Str::lower($title), Str::lower($search))) {
                continue;
            }

            if (isset($item->source)) {
                $source = $item->source;
                $attributes = $source->attributes();

                if ($attributes && isset($attributes['url'])) {
                    $sourceUrl = (string) $attributes['url'];
                }

                $sourceName = (string) $source;
            }

            if (!$sourceUrl && $sourceName) {
                $sourceUrl = "https://" . trim($sourceName);
            }

            $domain = $sourceUrl ? parse_url($sourceUrl, PHP_URL_HOST) : null;

            $publisherLogo = $domain
                ? "https://www.google.com/s2/favicons?sz=64&domain=" . $domain
                : null;

            $itemsArray[] = [
                'title' => Str::limit($title, 100),
                'link'  => (string) $item->link,
                'guid'  => (string) $item->guid,
                'pubDate' => (string) $item->pubDate,
                'description' => (string) $item->description,
                'source_name' => $sourceName,
                'source_url' => $sourceUrl,
                'publisher_logo' => $publisherLogo,
            ];
        }

        if (empty($itemsArray)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak Ada Data Yang Cocok'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $itemsArray
        ]);
    }
}
