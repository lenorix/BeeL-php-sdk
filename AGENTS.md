# Repository instructions

- Treat `src/Generated/` as read-only JanePHP output. Never edit, delete, format, regenerate, or run commands that write to it. If a task seems to require changing generated files, explain the conflict and keep the change outside that directory.
- `composer generate` (run by the maintainer) prepares the contract, regenerates `src/Generated/` and formats it with Pint, so the output matches what the CI style workflow commits.
- For BeeL API behavior and contract details, use https://docs.beel.es and https://docs.beel.es/api/openapi as the source of truth.
