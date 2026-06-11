// ─── Autenticação ────────────────────────────────────────────────────────────

if (sessionStorage.getItem('logado') === 'true') {
    document.getElementById('loginScreen').classList.add('hidden');
}

function autenticarEEntrar() {
    sessionStorage.setItem('logado', 'true');
    document.getElementById('loginScreen').classList.add('hidden');
}

// ─── Sub-perfil de cadastro ──────────────────────────────────────────────────

let perfilCadastroSelecionado = null;

function alterarSubPerfilCadastro(perfil) {
    perfilCadastroSelecionado = perfil;
    document.querySelectorAll('#cadastrosSubTabs .sub-tab-pill').forEach(p => p.classList.remove('active'));
    event.target.classList.add('active');

    document.querySelectorAll('.subclass-fields-block').forEach(b => b.classList.add('hidden'));

    if (perfil === 'Administrador') {
        document.getElementById('rowAdminFields').classList.remove('hidden');
    } else if (perfil === 'Docente') {
        document.getElementById('rowDocenteFields').classList.remove('hidden');
    } else if (perfil === 'Discente') {
        document.getElementById('rowDiscenteFields').classList.remove('hidden');
    } else if (perfil === 'Guardião') {
        document.getElementById('rowGuardiaoFields').classList.remove('hidden');
    }
    logOOP(`Campos dinâmicos injetados para herança da subclasse: [${perfil}].`);
}

// ─── Configuração dos módulos e suas abas ────────────────────────────────────

const modulosConfig = {
    'Administração': {
        abas: [
            { painel: 'painelCadastros'  },
            { painel: 'panelDisciplinas' },
            { painel: 'panelTurmas'      },
        ]
    },
    'Docente': {
        abas: [
            { painel: 'panelTurmas'      },
            { painel: 'panelDisciplinas' },
        ]
    },
    'Discente': {
        abas: [
            { painel: 'panelTurmas' },
        ]
    },
    'Guardião': {
        abas: [
            { painel: 'panelTurmas' },
        ]
    },
};

// ─── Estado da navegação ─────────────────────────────────────────────────────

let contextoAtual = 'Administração';
let abaAtualPorContexto = {};

// ─── Função principal de navegação ──────────────────────────────────────────

function redirecionarContexto(contexto) {
    contextoAtual = contexto;

    // 1. Atualiza botão ativo na sidebar
    document.querySelectorAll('.sidebar-link').forEach(btn => btn.classList.remove('active'));

    const idMap = {
        'Administração': 'menuAdmin',
        'Docente':       'menuDocente',
        'Discente':      'menuDiscente',
        'Guardião':      'menuGuardiao',
    };

    const btnAtivo = document.getElementById(idMap[contexto]);
    if (btnAtivo) btnAtivo.classList.add('active');

    // 2. Renderiza sub-abas do contexto
    const config  = modulosConfig[contexto];
    const tabsBar = document.getElementById('contextTabsBar');
    tabsBar.innerHTML = '';

    if (!config) return;

    config.abas.forEach((aba, idx) => {
        const pill = document.createElement('button');
        pill.className        = 'sub-tab-pill';
        pill.textContent      = aba.label;
        pill.dataset.painel   = aba.painel;
        pill.dataset.idx      = idx;

        pill.addEventListener('click', function () {
            abaAtualPorContexto[contextoAtual] = idx;
            ativarAba(contexto, idx);
        });

        tabsBar.appendChild(pill);
    });

    // 3. Reativa a última aba visitada neste contexto (ou a primeira)
    const ultimaAba = abaAtualPorContexto[contexto] ?? 0;
    ativarAba(contexto, ultimaAba);
}

// ─── Ativa uma aba específica dentro do contexto corrente ───────────────────

function ativarAba(contexto, idx) {
    const config = modulosConfig[contexto];
    if (!config) return;

    const abaAlvo = config.abas[idx];
    if (!abaAlvo) return;

    // Marca a pill ativa
    document.querySelectorAll('#contextTabsBar .sub-tab-pill').forEach((pill, i) => {
        pill.classList.toggle('active', i === idx);
    });

    // Coleta todos os painéis conhecidos e oculta todos
    const todosPaineis = new Set(
        Object.values(modulosConfig).flatMap(m => m.abas.map(a => a.painel))
    );

    todosPaineis.forEach(painelId => {
        const el = document.getElementById(painelId);
        if (el) el.classList.add('hidden');
    });

    // Exibe apenas o painel da aba selecionada
    const painelAlvo = document.getElementById(abaAlvo.painel);
    if (painelAlvo) painelAlvo.classList.remove('hidden');
}

// ─── Disciplinas ─────────────────────────────────────────────────────────────

let disciplinas = [
    { cod: '001', desc: 'Matemática',       status: 'ATIVO'   },
    { cod: '002', desc: 'Português',         status: 'ATIVO'   },
    { cod: '003', desc: 'Ciências',          status: 'ATIVO'   },
    { cod: '004', desc: 'Geografia',         status: 'INATIVO' },
];

let disciplinasSelecionadas = [];

function renderizarTabelaDisciplinas() {
    const tbody = document.getElementById('tableDisciplinasRows');
    if (!tbody) return;
    tbody.innerHTML = '';
    disciplinas.forEach((d, i) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${d.cod}</td><td>${d.desc}</td><td>${d.status}</td>`;
        tr.style.cursor = 'pointer';
        tr.addEventListener('click', () => {
            tr.classList.toggle('selected');
            if (tr.classList.contains('selected')) {
                disciplinasSelecionadas.push(i);
                document.getElementById('formDiscCod').value    = d.cod;
                document.getElementById('formDiscDesc').value   = d.desc;
                document.getElementById('formDiscStatus').value = d.status;
                if (document.getElementById('formDiscEmenta'))
                    document.getElementById('formDiscEmenta').value = d.ementa || '';
            } else {
                disciplinasSelecionadas = disciplinasSelecionadas.filter(x => x !== i);
            }
        });
        tbody.appendChild(tr);
    });
}

function adminCadastrarDisciplina() {
    const cod    = document.getElementById('formDiscCod').value.trim();
    const desc   = document.getElementById('formDiscDesc').value.trim();
    const ementa = document.getElementById('formDiscEmenta')?.value.trim() || '';

    if (!cod || !desc) { alert('Preencha Código e Descrição.'); return; }
    if (disciplinas.find(d => d.cod === cod)) { alert('Código já cadastrado.'); return; }

    disciplinas.push({ cod, desc, status: 'ATIVO', ementa });
    renderizarTabelaDisciplinas();
    alert(`Disciplina "${desc}" cadastrada com sucesso.`);
}

function adminRemoverDisciplina() {
    if (disciplinasSelecionadas.length === 0) { alert('Selecione uma disciplina na tabela.'); return; }
    disciplinas = disciplinas.filter((_, i) => !disciplinasSelecionadas.includes(i));
    disciplinasSelecionadas = [];
    renderizarTabelaDisciplinas();
}

function adminMudarStatusDisciplina(ativar) {
    if (disciplinasSelecionadas.length === 0) { alert('Selecione uma disciplina na tabela.'); return; }
    disciplinasSelecionadas.forEach(i => {
        disciplinas[i].status = ativar ? 'ATIVO' : 'INATIVO';
    });
    disciplinasSelecionadas = [];
    renderizarTabelaDisciplinas();
}

// ─── Turmas ──────────────────────────────────────────────────────────────────

let turmas = [
    { cod: 'T001', curso: 'Médio I',        semestre: '2026/1', vagas: 35, alunos: 28, status: 'ABERTA'  },
    { cod: 'T002', curso: 'Fundamental II', semestre: '2026/1', vagas: 30, alunos: 30, status: 'ABERTA'  },
    { cod: 'T003', curso: 'Médio I',        semestre: '2025/2', vagas: 35, alunos: 35, status: 'FECHADA' },
];

let turmaSelecionadaIdx = null;

function renderizarTabelaTurmas() {
    const tbody = document.getElementById('tableTurmasRows');
    if (!tbody) return;
    tbody.innerHTML = '';
    turmas.forEach((t, i) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${t.cod}</td><td>${t.curso}</td><td>${t.semestre}</td><td>${t.alunos}/${t.vagas}</td><td>${t.status}</td>`;
        tr.style.cursor = 'pointer';
        tr.addEventListener('click', () => {
            document.querySelectorAll('#tableTurmasRows tr').forEach(r => r.classList.remove('selected'));
            tr.classList.add('selected');
            turmaSelecionadaIdx = i;
        });
        tbody.appendChild(tr);
    });
}

function adminCriarTurma() {
    const curso    = document.getElementById('formTurmaCurso').value;
    const semestre = document.getElementById('formTurmaSemestre').value.trim();
    const vagas    = parseInt(document.getElementById('formTurmaVagas').value);

    if (!semestre || isNaN(vagas)) { alert('Preencha todos os campos obrigatórios.'); return; }

    const novoCod = 'T' + String(turmas.length + 1).padStart(3, '0');
    turmas.push({ cod: novoCod, curso, semestre, vagas, alunos: 0, status: 'ABERTA' });
    renderizarTabelaTurmas();
    alert(`Turma ${novoCod} criada com sucesso.`);
}

function adminFecharTurma() {
    if (turmaSelecionadaIdx === null) { alert('Selecione uma turma na tabela.'); return; }
    turmas[turmaSelecionadaIdx].status = 'FECHADA';
    turmaSelecionadaIdx = null;
    renderizarTabelaTurmas();
}

// ─── Utilitário de log (compatível com chamadas existentes) ──────────────────

function logOOP(msg) {
    console.log('[ConnectSchool]', msg);
}

// ─── Inicialização ───────────────────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', () => {
    redirecionarContexto('Administração');
    renderizarTabelaDisciplinas();
    renderizarTabelaTurmas();
});