# Marvel API

_Essa api foi desenvolvida a fim de suprir os endpoits que foram quebrados pelo Thanos, que subiu alguns commits errados quebrando os endpoits._

### Instruções de como executar a api

Os pré requisitos para a perfeita execução dessa api são:
 * Ambiente linux;
 * Ter o docker instalado na maquina, na versão 17.06.0+
 * Ter o docker composer instalado

Apos clonar o projeto, acesse a diretorio:

`cd marvel_api`

De permissão para a pasta storage do Laravel

`sudo chown -R www-data:www-data ./api/storage`

Execute o comando abaixo para iniciar todo o ambiente e subir a api:

`bash -c "bash ./start.sh && tail -f"`

Esse comando já irá baixar todas as imagens do docker, e configurar corretamente a aplicação;

### Endpoits da aplicação:

> /v1/public/characters
> * name (string)
> * orderBy 
> * limit (int)
> * offset (int)

> /v1/public/characters/{characterId}
> * characterId (int)
> * name (string)
> * orderBy 
> * limit (int)
> * offset (int)

> /v1/public/characters/{characterId}/comics
> * characterId (int)
> * title (string)
> * digitalId (int)
> * orderBy 
> * limit (int)
> * offset (int)

> /v1/public/characters/{characterId}/events
> * characterId (int)
> * name (string)
> * orderBy 
> * limit (int)
> * offset (int)

> /v1/public/characters/{characterId}/series
> * characterId (int)
> * title (string)
> * orderBy 
> * limit (int)
> * offset (int)

> /v1/public/characters/{characterId}/stories
> * characterId (int)
> * title (string)
> * orderBy 
> * limit (int)
> * offset (int)
