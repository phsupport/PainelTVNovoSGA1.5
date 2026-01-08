# Docker / Docker Compose

## Como usar ✅

- Build e subir desenvolvimenento:

```bash
docker compose up --build
```

A aplicação ficará disponível em: http://localhost:8080

## Notas 🔧

- O `Dockerfile` usa `php:8.2-apache` e habilita `mod_rewrite`.
- O `docker/php.ini` ativa exibição de erros (útil em dev). Em produção você deve ajustar essas opções.
- O `docker-compose.yml` mapeia o diretório atual para `/var/www/html` para desenvolvimento com hot edits.

Adicionei arquivos para produção:

- `Dockerfile.prod` — imagem otimizada para produção com extensões comuns e opcache configurado.
- `docker-compose.prod.yml` — compose sem volume montado e com healthcheck e limite de memória.
- `docker/php.prod.ini` — configuração de PHP para produção com opcache.
- `.env.example` — exemplo de variáveis de ambiente.

Para testar localmente:

```bash
# Build e run rápido
docker compose -f docker-compose.prod.yml up --build
```

Para um deploy de produção real, envie a imagem para um registry e use um orquestrador (Swarm, Kubernetes) e evite bind-mounts da fonte.

---

## Como rodar em produção (local para testes)
- Construa e rode:

```bash
# Build e run
docker compose -f docker-compose.prod.yml up --build
```

- Arquivos adicionados:
  - `Dockerfile.prod`
  - `docker-compose.prod.yml`
  - `docker/php.prod.ini`
  - `.env.example`
