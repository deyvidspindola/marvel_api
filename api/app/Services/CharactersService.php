<?php


namespace App\Services;


use App\Models\Character;

class CharactersService
{

    /**
     * @var Character
     */
    private $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function methods($characterId, $endpoint, $requests)
    {

        $this->validEndpoin($endpoint);

        $items = $this->search($characterId, $requests, $endpoint);

        $data = [
            'data' => [
                'offset' => $items['offset'],
                'limit' => $items['limit'],
                'total' => $items['total'],
                'count' => $items['count'],
            ]
        ];
        $i = 0;
        foreach ($items['items'] as $item){
            foreach ($item->toArray() as $key => $value){
                if (!in_array($key, ['created_at', 'updated_at', 'pivot']))
                $data['data']['results'][$i][$key] = $value;
            }
            $data['data']['results'][$i]['modified'] = $item->updated_at->format('Y-m-d H:i:s');
            $data['data']['results'][$i]['thumbnail'] = [
                "path" => json_decode($item->thumbnail)->path,
                "extension" => json_decode($item->thumbnail)->extension
            ];
            $data['data']['results'][$i]['resourceURI'] = url("/v1/public/characters/".$item->id);
            $data['data']['results'][$i]['urls'] = $this->getJson($item->urls, ['type', 'url']);

            if (is_null($endpoint)) {
                $data['data']['results'][$i]['comics'] = $this->getRelationships($item, 'comics');
                $data['data']['results'][$i]['series'] = $this->getRelationships($item, 'series');
                $data['data']['results'][$i]['stories'] = $this->getRelationships($item, 'stories');
                $data['data']['results'][$i]['events'] = $this->getRelationships($item, 'events');
            }else{
                $data['data']['results'][$i]['characters'] = $this->getRelationships($item, 'characters', 'comics');
                if ($endpoint != 'comics')
                    $data['data']['results'][$i]['comics'] = $this->getFakeRelationships($characterId, 'comics', $endpoint);

                if ($endpoint != 'series')
                    $data['data']['results'][$i]['series'] = $this->getFakeRelationships($characterId, 'series', $endpoint);

                if ($endpoint != 'stories')
                    $data['data']['results'][$i]['stories'] = $this->getFakeRelationships($characterId, 'stories', $endpoint);

                if ($endpoint != 'events')
                    $data['data']['results'][$i]['events'] = $this->getFakeRelationships($characterId, 'events', $endpoint);

                if ($endpoint == 'comics'){
                    $data['data']['results'][$i]['prices'] = $this->getJson($item->prices, ['type', 'price']);
                    $data['data']['results'][$i]['images'] = $this->getJson($item->images, ['path', 'extension']);
                }
            }

            $i++;
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

    private function validEndpoin($endpoint)
    {
        if (!is_null($endpoint) && !in_array($endpoint, ['comics', 'series', 'stories', 'events'])){
            throw new \Exception('O endpoint '.$endpoint.' é invalido', '409');
        }
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
