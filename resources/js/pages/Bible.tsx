import React, { useEffect, useState } from 'react';

const Bible = () => {
    const [bibles, setBibles] = useState([]);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        fetch('/api/bibles') // Fetching from Laravel API
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    setBibles(data.data);
                } else {
                    setError('Failed to load Bibles.');
                }
            })
            .catch((err) => setError(`An error occurred: ${err.message}`));
    }, []);

    if (error) {
        return <div className="text-red-500">{error}</div>;
    }

    return (
        <div className="p-6">
            <h1 className="text-xl font-bold mb-4">Available Bibles</h1>
            <ul>
                {bibles.map((bible: any) => (
                    <li key={bible.id} className="mb-2">
                        {bible.name} (Language: {bible.language.name})
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default Bible;
