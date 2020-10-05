<?php


namespace App\Services;


use App\Models\Character;

class CharactersService
{

    /**
     * @var Character
     */
    private $character;

    public function __construct(
        Character $character
    )
    {
        $this->character = $character;
    }

    public function characters($characterId)
    {

        $characters = $this->character->all();
        if (!is_null($characterId)){
            $characters = $this->character->whereId($characterId)->get();
        }

        $data = [
            'data' => [
                'offset' => 0,
                'limit' => 20,
                'total' => $this->character->all()->count(),
                'count' => $characters->count(),
            ]
        ];
        foreach ($characters as $character){
            $data['data']['results'][] = [
                'id' => $character->id,
                'name' => $character->name,
                'description' => $character->description,
                'modified' => $character->updated_at->format('Y-m-d H:i:s'),
                'thumbnail' => [
                    "path" => json_decode($character->thumbnail)->path,
                    "extension" => json_decode($character->thumbnail)->extension
                ],
                'resourceURI' => url("/v1/public/characters/".$character->id),
                'comics' => $this->getRelationships($character, 'comics'),
                'series' => $this->getRelationships($character, 'series'),
                'stories' => $this->getRelationships($character, 'stories'),
                'events' => $this->getRelationships($character, 'events'),
                'urls' => $this->getJson($character->urls, ['type', 'url']),
            ];
        }
        return $data;
    }

    public function comics($characterId)
    {
        $comics = $this->character->find($characterId)->comics;
        $data = [
            'data' => [
                'offset' => 0,
                'limit' => 20,
                'total' => $comics->count(),
                'count' => $comics->count(),
            ]
        ];
        foreach ($comics as $comic){
            $data['data']['results'][] = [
                'id' => $comic->id,
                'digitalId' => $comic->digitalId,
                'title' => $comic->title,
                'issueNumber' => $comic->issueNumber,
                'variantDescription' => $comic->variantDescription,
                'description' => $comic->description,
                'modified' => $comic->updated_at->format('Y-m-d H:i:s'),
                'isbn' => $comic->isbn,
                'upc' => $comic->upc,
                'diamondCode' => $comic->diamondCode,
                'ean' => $comic->ean,
                'issn' => $comic->issn,
                'format' => $comic->format,
                'pageCount' => $comic->pageCount,
                'textObjects' => [],
                'resourceURI' => url("/v1/public/characters/".$comic->id),
                'urls' => $this->getJson($comic->urls, ['type', 'url']),
                'series' => $this->getFakeRelationships($characterId, 'series', 'comics'),
                'variants' => [],
                'collections' => [],
                'collectedIssues' => [],
                'dates' => [],
                'prices' => $this->getJson($comic->prices, ['type', 'price']),
                'thumbnail' => [
                    "path" => json_decode($comic->thumbnail)->path,
                    "extension" => json_decode($comic->thumbnail)->extension
                ],
                'images' => $this->getJson($comic->images, ['path', 'extension']),
                'creators' => [

                ],
                'characters' => $this->getRelationships($comic, 'characters', 'comics'),
                'stories' => $this->getFakeRelationships($characterId, 'stories', 'comics'),
                'events' => $this->getFakeRelationships($characterId, 'events', 'comics'),

            ];
        }
        return $data;
    }

    public function series($characterId)
    {

        $series = $this->character->find($characterId)->series;

        $data = [
            'data' => [
                'offset' => 0,
                'limit' => 20,
                'total' => $series->count(),
                'count' => $series->count(),
            ]
        ];
        foreach ($series as $serie){
            $data['data']['results'][] = [
                'id' => $serie->id,
                'title' => $serie->title,
                'description' => $serie->description,
                'resourceURI' => url("/v1/public/series/".$serie->id),
                'urls' => $this->getJson($serie->urls, ['type', 'url']),
                'startYear' => $serie->startYear,
                'endYear' => $serie->endYear,
                'rating' => $serie->rating,
                'type' => $serie->type,
                'modified' => $serie->updated_at->format('Y-m-d H:i:s'),
                'thumbnail' => [
                    "path" => json_decode($serie->thumbnail)->path,
                    "extension" => json_decode($serie->thumbnail)->extension
                ],
                'creators' => [

                ],
                'characters' => $this->getRelationships($serie, 'characters', 'series'),
                'stories' => $this->getFakeRelationships($characterId, 'stories', 'series'),
                'comics' => $this->getFakeRelationships($characterId, 'comics', 'series'),
                'events' => $this->getFakeRelationships($characterId, 'events', 'series')
            ];
        }
        return $data;
    }

    public function stories($characterId)
    {

        $stories = $this->character->find($characterId)->stories;

        $data = [
            'data' => [
                'offset' => 0,
                'limit' => 20,
                'total' => $stories->count(),
                'count' => $stories->count(),
            ]
        ];
        foreach ($stories as $story){
            $data['data']['results'][] = [
                'id' => $story->id,
                'title' => $story->title,
                'description' => $story->description,
                'resourceURI' => url("/v1/public/stories/".$story->id),
                'urls' => $this->getJson($story->urls, ['type', 'url']),
                'modified' => $story->updated_at->format('Y-m-d H:i:s'),
                'thumbnail' => [
                    "path" => json_decode($story->thumbnail)->path,
                    "extension" => json_decode($story->thumbnail)->extension
                ],
                'creators' => [

                ],
                'characters' => $this->getRelationships($story, 'characters',  'stories'),
                'stories' => $this->getFakeRelationships($characterId, 'stories', 'stories'),
                'comics' => $this->getFakeRelationships($characterId, 'comics', 'stories'),
                'events' => $this->getFakeRelationships($characterId, 'events', 'stories'),
                'originalIssue' => []
            ];
        }
        return $data;
    }

    public function events($characterId)
    {

        $events = $this->character->find($characterId)->events;

        $data = [
            'data' => [
                'offset' => 0,
                'limit' => 20,
                'total' => $events->count(),
                'count' => $events->count(),
            ]
        ];
        foreach ($events as $event){
            $data['data']['results'][] = [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'resourceURI' => url("/v1/public/events/".$event->id),
                'urls' => $this->getJson($event->urls, ['type', 'url']),
                'modified' => $event->updated_at->format('Y-m-d H:i:s'),
                'start' => $event->start,
                'end' => $event->end,
                'thumbnail' => [
                    "path" => json_decode($event->thumbnail)->path,
                    "extension" => json_decode($event->thumbnail)->extension
                ],
                'creators' => [

                ],
                'characters' => $this->getRelationships($event, 'characters',  'events'),
                'stories' => $this->getFakeRelationships($characterId, 'stories', 'events'),
                'comics' => $this->getFakeRelationships($characterId, 'comics', 'events'),
                'events' => $this->getFakeRelationships($characterId, 'events', 'events'),
                'originalIssue' => []
            ];
        }
        return $data;
    }

    private function getJson($items, $array)
    {
        $data = array();
        $items = json_decode($items);
        if (is_array($items))
            foreach ($items as $k => $item){
                foreach ($array as $key => $value){
                    $data[$k][$value] = $item->$value;
                }
            }

        return $data;
    }

    private function getRelationships($data, $type, $endpoind = 'characters')
    {
        $items = $data->$type;

        $data = [
            "available" => $items->count(),
            "collectionURI" => url("/v1/public/".$endpoind."/".$data->id."/".$type),
            "items" => [],
            'returned' => $items->count()
        ];

        foreach ($items as $item){
            $data['items'][] = [
                "resourceURI" => url("/v1/public/".$type."/".$item->id),
                "name" => (in_array($type, ['characters', 'creators'])) ? $item->name  : $item->title
            ];
        }

        return $data;

    }

    private function getFakeRelationships($data, $type, $endpoind = 'characters')
    {

        $items = $this->character->find($data)->$type;

        $data = [
            "available" => $items->count(),
            "collectionURI" => url("/v1/public/".$endpoind."/".$data."/".$type),
            "items" => [],
            'returned' => $items->count()
        ];

        foreach ($items as $item){
            $data['items'][] = [
                "resourceURI" => url("/v1/public/".$type."/".$item->id),
                "name" => (in_array($type, ['characters', 'creators'])) ? $item->name  : $item->title
            ];
        }

        return $data;

    }

}
