<?php


namespace App\Services;


use App\Models\Character;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

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

    public function characters($characterId, $requests)
    {
        $characters = $this->search($characterId, $requests);

        $data = [
            'data' => [
                'offset' => $characters['offset'],
                'limit' => $characters['limit'],
                'total' => $characters['total'],
                'count' => $characters['count'],
            ]
        ];
        foreach ($characters['items'] as $character){
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

    public function comics($characterId, $requests)
    {
        $comics = $this->search($characterId, $requests, 'comics');

        $data = [
            'data' => [
                'offset' => $comics['offset'],
                'limit' => $comics['limit'],
                'total' => $comics['total'],
                'count' => $comics['count'],
            ]
        ];
        foreach ($comics['items'] as $comic){
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

    private function search($characterId, $requests = null, $types = null)
    {
        if (!is_null($types)){
            $character = $this->character->find($characterId);
            $items = $character->$types;
            $total = $items->count();
            if (!is_null($requests)){
                $where = array();
                foreach ($requests as $key => $value){
                    if (!in_array($key, ['offset','limit','orderBy'])){
                        if (in_array($key, ['name', 'title', 'digitalId'])){
                            if (empty($value))
                                throw new \Exception('O parametro passado está vazio', '409');

                            if(in_array($types, ['characters', 'creators']) && $key == 'title')
                                throw new \Exception('O parametro '.$key.' é invalido', '409');

                            if(!in_array($types, ['characters', 'creators']) && $key == 'name')
                                throw new \Exception('O parametro '.$key.' é invalido', '409');

                            if (in_array($key, ['name', 'title']) && is_numeric($value))
                                throw new \Exception('O parametro '.$key.' não é uma string', '409');

                            if (in_array($key, ['digitalId']) && !is_numeric($value))
                                throw new \Exception('O parametro '.$key.' não é um inteiro', '409');
                            
                            $where[] = [$key, '=', $value];
                        }else{
                            throw new \Exception('Não é possivel buscar por esse parametro', '409');
                        }
                    }
                }
                $items = $character->$types()->where($where);

                if (isset($requests['offset']))
                    $items = $items->offset($requests['offset']);

                if (isset($requests['limit']))
                    $items = $items->limit($requests['limit']);

                if (isset($requests['orderBy']))
                    $items = $items->orderBy($requests['orderBy']);

                $items = $items->get();
            }
        }else{
            if (!is_null($requests) && !empty($requests)){
                $where = array();
                foreach ($requests as $key => $value){
                    if (!in_array($key, ['offset','limit','orderBy'])){
                        if (in_array($key, ['name'])){
                            if (empty($value))
                                throw new \Exception('O parametro passado está vazio', '409');

                            $where[] = [$key, '=', $value];
                        }else{
                            throw new \Exception('Não é possivel buscar por esse parametro', '409');
                        }
                    }
                }
                $items = $this->character->where($where);

                if (isset($requests['offset']))
                    $items = $items->offset($requests['offset']);

                if (isset($requests['limit']))
                    $items = $items->limit($requests['limit']);

                if (isset($requests['orderBy']))
                    $items = $items->orderBy($requests['orderBy']);

                $items = $items->get();
            }else{
                $items = $this->character->all();
                if (!is_null($characterId)){
                    $items = $this->character->whereId($characterId)->get();
                }
            }
            $total = $items->count();
        }

        return [
            'offset' => (!is_null($requests) && !isset($requests['offset'])) ? 0 : $requests['offset'],
            'limit' => (!is_null($requests) && !isset($requests['limit'])) ? 0 : $requests['limit'],
            'total' => $total,
            'count' => $items->count(),
            'items' => $items,
        ];

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
