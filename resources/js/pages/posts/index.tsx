import { Link } from '@inertiajs/react';
import { route } from 'ziggy-js';

interface User {
    id: number;
    name: string;
    posts: {
    id: number;
    title: string;
}[];
}

interface IndexProps {
    users: User[];
}

export default function Index({ users }) {
    return (
        <div className="p-8">
            {users.map(u => (
                <div key={u.id}>
                    <h2>{u.name}</h2>
                    <ul>
                    {u.posts.map(p => (
                        <div>
                            <li key={p.id}>
                            <Link href={route('post.show', { id: p.id })}>{p.title}</Link>
                            </li>
                        </div>
                    ))}
                    </ul>
                    <hr/>
                </div>
            ))}
        </div>
    );
}