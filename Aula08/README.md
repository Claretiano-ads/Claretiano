# Aula 08 - JavaScript: Manipulação Dinâmica do DOM e Estilos CSS

## 🎯 Objetivo da Aula
Avançar a lógica de validação iniciada na Aula 07, eliminando as caixas de alerta (`window.alert()`) e ensinando os alunos a **manipular elementos HTML e estilos CSS diretamente na página** em tempo real.

---

## 🔄 Evolução Pedagógica: Aula 07 ➔ Aula 08

| Aspecto | Aula 07 (Introdução) | Aula 08 (DOM & CSS Dinâmico) |
| :--- | :--- | :--- |
| **Feedback ao usuário** | `window.alert(...)` (popup intrusivo) | Mensagens na tela via `.textContent` em tags `<span>` |
| **Estilo dos campos** | Estático | Dinâmico: bordas vermelhas no erro e verdes no sucesso |
| **Declaração de variáveis** | Apenas `var` | Apresentação de `const` e `let` |
| **Validação lógica** | Apenas checar se vazio (`== ""`) | Mínimo de caracteres (`.length`) e igualdade de senhas |
| **Experiência do Usuário (UX)** | Interrompe o fluxo | Suave, moderna e profissional |

---

## 📚 Novos Conceitos Apresentados

1. **Manipulação de Conteúdo com `.textContent`:**
   * Escreve texto seguro diretamente dentro de elementos HTML (ex: `<span id="erroUsuario"></span>`).
2. **Manipulação de Classes CSS com `.classList`:**
   * `elemento.classList.add("campo-erro")`: aplica a borda vermelha.
   * `elemento.classList.remove("campo-erro")`: limpa o erro ao corrigir.
3. **Propriedades de Texto:**
   * `.length`: descobre a quantidade de caracteres digitados.
   * `.trim()`: remove espaços em branco acidentais antes e depois do texto.
4. **Boas Práticas Modernas:**
   * `const`: para elementos HTML fixos do DOM.
   * `let`: para variáveis que mudam durante o fluxo (ex: `formularioValido`).
5. **Reset de Estados:**
   * Limpar erros antigos antes de iniciar uma nova validação para não acumular mensagens incorretas.

---

## 🗂️ Estrutura de Arquivos da Aula 08

```text
Aula08/
├── cadastro.html                    # Exemplo completo demonstrado pelo professor
├── estilo.css                       # Estilização com classes dinâmicas (.campo-erro, .status-box)
├── script.js                        # Lógica da validação no DOM sem alerts
├── README.md                        # Guia pedagógico e roteiro da aula
└── Atividade08-NomeAlunoRA/         # Template para prática individual dos alunos
    ├── cadastro.html
    ├── estilo.css
    └── script.js
```

---

## 🧪 Atividade de Laboratório (Para os Alunos)

Os alunos deverão duplicar a pasta `Atividade08-NomeAlunoRA` renomeando com seu próprio **Nome e RA** (ex: `Atividade08-JoaoSilva1234567`) e cumprir os desafios:

1. **Desafio 1 (Nome):** Validar se o nome foi preenchido e possui mais de 3 letras.
2. **Desafio 2 (E-mail):** Validar se o e-mail foi preenchido e contém o caractere `@` (usando `.includes("@")`).
3. **Desafio 3 (Senha):** Garantir que a senha possua no mínimo 6 caracteres.
4. **Desafio 4 (UX Sem Pop-ups):** Em caso de erro, destacar os campos com a classe `campo-erro` e escrever na `<span>`. Se tudo estiver correto, exibir mensagem na caixa de sucesso na própria tela.
