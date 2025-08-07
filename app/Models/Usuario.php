<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Semge\Autenticacao\UsuarioLogin;
use Semge\Core\UsuarioTrait;
use Semge\Interfaces\UsuarioInterface;
use Yajra\DataTables\DataTables;

class Usuario extends Authenticatable implements UsuarioInterface
{
    use HasFactory;
    use UsuarioTrait;

    protected $connection = 'mysql';
    protected $table = 'usuario';
    protected $cpf;

    protected $with = ['getOrgao'];

    protected $fillable = [
        'name', 'cpf', 'email', 'senha','id_orgao'
    ];

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute)
        {
            parent::setAttribute($key, $value);
        }
    }


    public function getClasseLogin()
    {
        return new UsuarioLogin;
    }

    protected function nomeUsuario()
    {
        return 'cpf';
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getGuard(){
        return $this->guard;
    }

    public function acesso()
    {
        return $this->hasMany('App\Models\AcessoChristi', 'id_usuario');
    }

    public function getPerfilSigs()
    {
        $acessos = $this->acesso;
        $sigs = SistemaChristi::where('code_name','sigs_app')->get()->first();
        foreach ($acessos as $acesso) {
            if($acesso->sistemaPerfil->id_sistema == $sigs->id){
                return $acesso->sistemaPerfil->perfil;
            }
        }
        return null;
    }

//    public function getPerfil()
//    {
//        $sigs = SistemaChristi::where('code_name','sigs_app')->get()->first();
//        $sistemaPerfil = new SistemaPerfilChristi();
//        $systemPerfil = $sistemaPerfil->query()->where('id_sistema', '=', $sigs->id)->get();
//        $perfil = new PerfilChristi();
//
//        foreach ($systemPerfil as $sys) {
////            $perfil->newQuery()->where('id', '=', $sys->id_perfil)->get();
//            dd("Debug foreach - ", $perfil->newQuery()->where('id', '=', $sys->id_perfil)->get());
//        }
//
//
//
//        dd("Debug no systemPerfil - ", $systemPerfil);
//    }

    public function getOrgao() {
        return $this->hasOne('App\Models\OrgaoUsuario', 'id', 'id_orgao');
    }

    public function getUsuariosSigsHomologa()
    {
        $query = $this->newQuery()
            ->select('usuario.id' , 'usuario.nome', 'usuario.id_orgao', 'usuario.ativo', 'sistema.descricao as sistema', 'perfil.id as id_perfil', 'perfil.descricao as perfil', 'perfil.code_name')
            ->join('acesso', 'usuario.id', '=', 'acesso.id_usuario')
            ->join('sistema_perfil', 'acesso.id_sistema_perfil', '=', 'sistema_perfil.id')
            ->join('sistema', 'sistema.id', '=', 'sistema_perfil.id_sistema')
            ->join('perfil', 'sistema_perfil.id_perfil', '=', 'perfil.id')
            ->where('sistema.id', '=', 14);

        return $query->get();
    }

    public function getUsuariosSigsPerfilTecnicoAndAdmin()
    {
        $query = DB::connection('mysql')->getPdo()
            ->query("select  usuario.* 
                              from usuario inner join acesso on usuario.id = acesso.id_usuario 
                              inner join sistema_perfil on acesso.id_sistema_perfil = sistema_perfil.id 
                              inner join sistema on sistema.id = sistema_perfil.id_sistema 
                              inner join perfil on sistema_perfil.id_perfil = perfil.id 
                              where usuario.id_orgao = 502 
                              and acesso.id_sistema_perfil in (60, 69) ORDER BY usuario.nome ASC");
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function getUsuariosSigs()
    {
        $query = $this->newQuery()
            ->select('usuario.id' , 'usuario.nome', 'usuario.email', 'usuario.id_orgao', 'usuario.ativo', 'sistema.descricao as sistema', 'perfil.id as id_perfil', 'perfil.descricao as perfil', 'perfil.code_name')
            ->join('acesso', 'usuario.id', '=', 'acesso.id_usuario')
            ->join('sistema_perfil', 'acesso.id_sistema_perfil', '=', 'sistema_perfil.id')
            ->join('sistema', 'sistema.id', '=', 'sistema_perfil.id_sistema')
            ->join('perfil', 'sistema_perfil.id_perfil', '=', 'perfil.id')
            ->where('sistema.id', '=', 14)
            ->where('usuario.ativo', '=', 1)
            ->orderBy('usuario.nome');

        return $query->get();
    }

    public function getUsuarioSigsById($id)
    {
        $query = $this->newQuery()
            ->select('usuario.id' , 'usuario.nome', 'usuario.email', 'usuario.id_orgao', 'usuario.ativo', 'sistema.descricao as sistema', 'perfil.id as id_perfil', 'perfil.descricao as perfil', 'perfil.code_name', 'usuario.cpf')
            ->join('acesso', 'usuario.id', '=', 'acesso.id_usuario')
            ->join('sistema_perfil', 'acesso.id_sistema_perfil', '=', 'sistema_perfil.id')
            ->join('sistema', 'sistema.id', '=', 'sistema_perfil.id_sistema')
            ->join('perfil', 'sistema_perfil.id_perfil', '=', 'perfil.id')
            ->where('sistema.id', '=', 14)
            ->where('usuario.id', '=', $id)
            ->orderBy('usuario.nome');

        return $query->get();
    }

    public function getUsuarioSgrById($id)
    {
        $query = $this->newQuery()
            ->select('usuario.id' , 'usuario.nome', 'usuario.email', 'usuario.id_orgao', 'usuario.ativo', 'sistema.descricao as sistema', 'perfil.id as id_perfil', 'perfil.descricao as perfil', 'perfil.code_name', 'usuario.cpf', 'sistema_perfil.id as id_sistema_perfil')
            ->join('acesso', 'usuario.id', '=', 'acesso.id_usuario')
            ->join('sistema_perfil', 'acesso.id_sistema_perfil', '=', 'sistema_perfil.id')
            ->join('sistema', 'sistema.id', '=', 'sistema_perfil.id_sistema')
            ->join('perfil', 'sistema_perfil.id_perfil', '=', 'perfil.id')
            ->where('sistema.id', '=', 16)
            ->where('usuario.id', '=', $id)
            ->orderBy('usuario.nome');

        return $query->first()->toArray();
    }

    public function getUsuariosSgrPerfilGestor()
    {
        $query = $this->newQuery()
            ->select('usuario.id' , 'usuario.nome', 'usuario.email', 'usuario.id_orgao', 'usuario.ativo', 'sistema.descricao as sistema', 'perfil.id as id_perfil', 'perfil.descricao as perfil', 'perfil.code_name', 'usuario.cpf', 'sistema_perfil.id as id_sistema_perfil')
            ->join('acesso', 'usuario.id', '=', 'acesso.id_usuario')
            ->join('sistema_perfil', 'acesso.id_sistema_perfil', '=', 'sistema_perfil.id')
            ->join('sistema', 'sistema.id', '=', 'sistema_perfil.id_sistema')
            ->join('perfil', 'sistema_perfil.id_perfil', '=', 'perfil.id')
            ->where('sistema.id', '=', 16)
            ->where('acesso.id_sistema_perfil', '=', 75)
            ->orderBy('usuario.nome');

        return $query->get()->toArray();
    }

    public function getUsuariosSgrPerfilAnalistaRisco()
    {
        $query = $this->newQuery()
            ->select('usuario.id' , 'usuario.nome', 'usuario.email', 'usuario.id_orgao', 'usuario.ativo', 'sistema.descricao as sistema', 'perfil.id as id_perfil', 'perfil.descricao as perfil', 'perfil.code_name', 'usuario.cpf', 'sistema_perfil.id as id_sistema_perfil')
            ->join('acesso', 'usuario.id', '=', 'acesso.id_usuario')
            ->join('sistema_perfil', 'acesso.id_sistema_perfil', '=', 'sistema_perfil.id')
            ->join('sistema', 'sistema.id', '=', 'sistema_perfil.id_sistema')
            ->join('perfil', 'sistema_perfil.id_perfil', '=', 'perfil.id')
            ->where('sistema.id', '=', 16)
            ->where('acesso.id_sistema_perfil', '=', 74)
            ->orderBy('usuario.nome');

        return $query->get()->toArray();
    }

    public function getNomeUsuarioById($id)
    {
        $query = $this->newQuery()->select('nome')->where('id', '=', $id)->first()->toArray()['nome'];
        return $query;
    }

    public function getEmailsUsuariosSigsByIds($ids)
    {
        $query = DB::connection('mysql')->getPdo()
            ->query("SELECT usuario.email, 
                                     usuario.nome
                              FROM usuario 
                              INNER JOIN acesso ON usuario.id = acesso.id_usuario 
                              INNER JOIN sistema_perfil ON acesso.id_sistema_perfil = sistema_perfil.id 
                              INNER JOIN sistema ON sistema.id = sistema_perfil.id_sistema 
                              INNER JOIN perfil ON sistema_perfil.id_perfil = perfil.id 
                              WHERE sistema.id = 14
                              AND usuario.id IN ($ids) ORDER BY usuario.nome ASC");
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function getOrgaosChristi()
    {
        $query = DB::connection('mysql')->getPdo()
            ->query("SELECT o.id, o.descricao, o.sigla FROM orgao o WHERE o.ativado = 1 ");

        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function getOrgaoChristiById($id)
    {
        $query = DB::connection('mysql')->getPdo()
            ->query("SELECT o.id, o.descricao, o.sigla FROM orgao o WHERE o.ativado = 1 and o.id = {$id} ");

        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function getPerfisSgrChristi()
    {
        $query = DB::connection('mysql')->getPdo()
            ->query("SELECT p.id AS id_perfil,
                                     p.descricao,
                                     sp.id_sistema,
                                     sp.id as id_sistema_perfil
                              FROM sistema_perfil sp, perfil p  
                              WHERE sp.id_sistema = 16 
                              AND p.id = sp.id_perfil");

        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function insertUsuarioSgrChristi($request)
    {
        try {
            $data = $request->all();

//            dd("Debug no data - ", trim($data['email']));

            \DB::beginTransaction();

            $usuario_cadastrado = DB::connection('mysql')->table('usuario')->where('cpf', $this->remove_formatacao($data['cpf']))->first();
            if ($usuario_cadastrado) {
                throw new \Exception("CPF já cadastrado.");
            }

            $email_cadastrado = DB::connection('mysql')->table('usuario')->where('email', trim($data['email']))->first();
            if ($email_cadastrado) {
                throw new \Exception("E-mail já cadastrado.");
            }

            $data_usuario = [
                'nome' => $data['nome'],
                'cpf' => $this->remove_formatacao($data['cpf']),
                'email' => trim($data['email']),
                'senha' => Hash::make($data['senha']),
                'id_orgao' => $data['id_orgao'],
                'ativo' => 1,
                'data_criacao' => Carbon::now('America/Sao_Paulo'),
                'data_atualizacao' => Carbon::now('America/Sao_Paulo'),
            ];

            $id_usuario = DB::connection('mysql')->table('usuario')->insertGetId($data_usuario);

            $data_acesso = [
                'id_usuario' => $id_usuario,
                'id_sistema_perfil' => $data['id_sistema_perfil']
            ];

            DB::connection('mysql')->table('acesso')->insertGetId($data_acesso);

            \DB::commit();
            return redirect()->route('view.gerenciar_permissao')->with('message', 'Usuário cadastrado com Sucesso!');
        } catch (\Exception $e) {
            \DB::rollBack();

            \Log::error($e);
            return back()->withInput()->with('message-error', $e->getMessage());
        }
    }

    public function updateUsuarioSgrChristi($request, $id)
    {
        try {
            \DB::beginTransaction();
            $data = $request->all();

            $data_usuario = [
                'nome' => $data['nome'],
                'cpf' => $this->remove_formatacao($data['cpf']),
                'email' => $data['email'],
                'id_orgao' => $data['id_orgao'],
                'ativo' => 1,
                'data_atualizacao' => Carbon::now('America/Sao_Paulo'),
            ];

            if (isset($data['senha']) && $data['senha'] != null) {
                $data_usuario['senha'] = Hash::make($data['senha']);
            }

            DB::connection('mysql')->table('usuario')->where('id', '=', $id)->update($data_usuario);

            $query_acesso = DB::connection('mysql')->getPdo()
                ->query("SELECT a.id  
                                  FROM sistema_perfil sp, acesso a  
                                  WHERE sp.id_sistema = 16
                                  AND a.id_sistema_perfil = sp.id 
                                  AND a.id_usuario = $id");

            $acesso_id = $query_acesso->fetch(\PDO::FETCH_ASSOC);

            $data_acesso = [
                'id_sistema_perfil' => $data['id_sistema_perfil']
            ];

            DB::connection('mysql')->table('acesso')->where('id', '=', $acesso_id['id'])->update($data_acesso);

            \DB::commit();
            return redirect()->route('view.gerenciar_permissao')->with('message', 'Usuário atualizado com Sucesso!');
        } catch (\Exception $e) {
            \DB::rollBack();

            \Log::error($e);
            return back()->withInput()->with('message-error', $e->getMessage());
        }
    }

    public function deleteUsuarioSgrChristi($id)
    {
        try {
            \DB::beginTransaction();

            $query_acesso = DB::connection('mysql')->getPdo()
                ->query("SELECT a.id  
                                  FROM sistema_perfil sp, acesso a  
                                  WHERE sp.id_sistema = 16
                                  AND a.id_sistema_perfil = sp.id 
                                  AND a.id_usuario = $id");

            $acesso_id = $query_acesso->fetch(\PDO::FETCH_ASSOC);

            $acesso_deletado = DB::connection('mysql')->table('acesso')->where('id', '=', $acesso_id['id'])->delete();

            if ($acesso_deletado == 0) {
                throw new \Exception("Ops, ocorreu um error na exclusão do usuário, por favor entre em contato com o NTI.");
            }

            $usuario_desativado = DB::connection('mysql')->table('usuario')->where('id', '=', (int)$id)->update(['ativo' => 0]);

            if ($usuario_desativado == 0) {
                throw new \Exception("Ops, ocorreu um error na exclusão do usuário, por favor entre em contato com o NTI.");
            }

            \DB::commit();
            return redirect()->route('view.gerenciar_permissao')->with('message', 'Usuário deletado com Sucesso!');
        } catch (\Exception $e) {
            \DB::rollBack();

            \Log::error($e);
            return back()->withInput()->with('message-error', $e->getMessage());
        }
    }

    public function getPerfilChristiSigsByOrgaoId($id)
    {
        $query = null;
        if ($id == 502) {
            $query = DB::connection('mysql')->getPdo()
                ->query("SELECT p.id AS id_perfil,
                                     p.descricao,
                                     sp.id_sistema,
                                     sp.id as id_sistema_perfil
                              FROM sistema_perfil sp, perfil p  
                              WHERE sp.id_sistema = 14 
                              AND p.id = sp.id_perfil");

        } else {
            $query = DB::connection('mysql')->getPdo()
                ->query("SELECT p.id AS id_perfil,
                                   p.descricao,
                                   sp.id_sistema,
                                   sp.id as id_sistema_perfil
                            FROM sistema_perfil sp, perfil p  
                            WHERE sp.id_sistema = 14 
                            AND p.id = sp.id_perfil
                            and p.id = 51");
        }


        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function getEmailsAndNomesUsuariosSigsPerfilCliente($nome)
    {
        $query = DB::connection('mysql')->getPdo()
            ->query("SELECT usuario.id, 
                                     usuario.email, 
                                     usuario.nome,
                                     perfil.descricao 
                              FROM usuario 
                              INNER JOIN acesso ON usuario.id = acesso.id_usuario 
                              INNER JOIN sistema_perfil ON acesso.id_sistema_perfil = sistema_perfil.id 
                              INNER JOIN sistema ON sistema.id = sistema_perfil.id_sistema 
                              INNER JOIN perfil ON sistema_perfil.id_perfil = perfil.id 
                              WHERE sistema.id = 14
                              AND perfil.id in (51, 50)
                              AND usuario.nome like '%{$nome}%'
                              ORDER BY usuario.nome asc");
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function getUnidadesChristiByIdOrgao($id)
    {
        $query = DB::connection('mysql')->getPdo()
            ->query("select * from unidade u where u.id_orgao = {$id} ");

        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function getUnidadesChristiById($id)
    {
        $query = DB::connection('mysql')->getPdo()
            ->query("select * from unidade u where u.id = {$id} ");

        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function remove_formatacao($numero) {
        $numero = str_replace(['.', '-', '/', ','], '', $numero);
        return $numero;
    }

    public function getPerfilChristiById($id)
    {
        $query = DB::connection('mysql')->getPdo()
            ->query("select p.descricao from perfil p where p.id = {$id} ");

        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function anyDataUsuariosSgr()
    {
        $usuarios = $this->newQuery()
            ->select('usuario.id' , 'usuario.nome', 'usuario.email', 'usuario.id_orgao', 'usuario.ativo', 'sistema.descricao as sistema', 'perfil.id as id_perfil', 'perfil.descricao as perfil', 'perfil.code_name', 'usuario.cpf')
            ->join('acesso', 'usuario.id', '=', 'acesso.id_usuario')
            ->join('sistema_perfil', 'acesso.id_sistema_perfil', '=', 'sistema_perfil.id')
            ->join('sistema', 'sistema.id', '=', 'sistema_perfil.id_sistema')
            ->join('perfil', 'sistema_perfil.id_perfil', '=', 'perfil.id')
            ->where('sistema.id', '=', 16)
            ->orderBy('usuario.nome');

        $datatable = DataTables::of($usuarios)
            ->editColumn('id_perfil', function ($usuarios) {
                $perfil = $this->getPerfilChristiById((int)$usuarios->id_perfil);
                if ($perfil) {
                    return $perfil['descricao'];
                } else {
                    return '-';
                }
            })
            ->editColumn('acao', function ($usuarios) {

                $acoes_list = "
                    <td>
                        <a href='/edit-usuario/{$usuarios->id}' class='link_table_acoes' ><i class='fa-solid fa-pen'></i></a>                        
                        <a href='/delete-usuario/{$usuarios->id}' class='link_table_acoes'><i class='fa-solid fa-trash'></i></a>
                    </td>
                ";

                return $acoes_list;
            })
            ->rawColumns(['acao'])
            ->make(true);

        return $datatable;
    }
}
