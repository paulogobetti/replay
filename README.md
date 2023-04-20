[ ] PWA (responsivo <= 512px de largura - janela pequena estilo Winamp) // Verificar se é possível só com JS.

[ ] Equalizer.

[ ] API para criação de temas.

[ ] Integração com Last.fm.

[ ] Spectogram.

[ ] Contagem regressiva de tempo em segundos.

[ ] Controles: Play, Pause, Avançar, Voltar, Volume, Timeline (da música tocando).

[ ] Retornar as metatags usando JS (provavelmente não tem como); caso não dê, usar PHP para ler e JSON retornando algum objeto literal para o player.
// Aqui pode ser um problema se nem o PHP fizer isso, uma solução será passar tudo para JSON mesmo e criar objetos com as metatags no momento do download.
// Mas aí teria o problema de setar as tags corretamente e ainda escrevê-las nos arquivos de áudio.
// fopen.

[ ] Compressor?

[ ] Listagem com filtro e pesquisa utilizando JSON.

= = = = = = =

Listagem (tabela)
// Seguir esse padrão para exibir qualquer lista, seja a home, uma playlist ou um álbum.
// Lista paginada.
// O 'wireframe' será um componente e o conteúdo totalmente dinâmico.
// Talvez posteriormente criar front-end próprio para o album ou artista, listando apenas determinados elementos ~talvez.
// Desafio: como tratar remixes? // Provavelmente será listado na página do artista errado.
COVER | PLAY | ADD TO PLAYLIST | TITLE | ARTIST | ALBUM | DURATION | RELEASE
